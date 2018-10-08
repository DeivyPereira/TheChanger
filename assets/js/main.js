$(document).ready(function(){
            
    var base_url = 'http://www.disenoydesarrollo.web.ve/cexpress/';

    $('#selectPaisTax').on('change', function(){
        var pais = $('#selectPaisTax').val();
        $.ajax({
            url: base_url + 'get_tax_pais',
            data: {'pais': pais},
            method: 'post',
            beforeSend: function(){
                $('#loader').fadeIn('fast');
            },
            success: function(result){
                $('#loader').fadeOut('fast');
                if( result == "false"){
                    $('#tasaPaisConsulta').html('<i class="ti-info-alt"></i>&nbsp;Debe seleccionar un país de la lista');
                } else {
                    $('#tasaPaisConsulta').html(result);
                }
            }
        });
    });

    $('#paisCuentas').on('change', function(){
        var pais = $('#paisCuentas').val();
        $.ajax({
            url: base_url + 'get_cuentas_admin',
            data: {'pais': pais},
            method: 'post',
            beforeSend: function(){
                $('#loader').fadeIn('fast');
            },
            success: function(result){
                $('#loader').fadeOut('fast');
                if( result == "false"){
                    $('#cuentasPaisList').html('<i class="ti-info-alt"></i>&nbsp;No hay bancos registrados');
                } else {
                    $('#cuentasPaisList').html(result);
                }
            }
        });
    });

    $('#seleccionaCuenta').submit(function(){
        event.preventDefault();
        var id = $('#cuentaId').val(),
            mes = $('#cuentaMes').val(),
            ano = $('#cuentaAno').val();
        $.ajax({
            url: base_url + 'estados_template',
            data: { 'id': id, 'mes': mes, 'ano': ano },
            method: 'post',
            beforeSend: function(){
                $('#loader').fadeIn('fast');
                $('#avisoCuenta').addClass('display-none');
            },
            success: function(result){
                $('#loader').fadeOut('fast');
                $('#estadoBody').html(result);
            }
        });
    });

    $('#dashCalcPaisOr').on('change', function(){
        $('#loader').fadeIn('fast');
        var pais_origen = $('#dashCalcPaisOr').val(),
            pais_beneficiario = "Venezuela";
        $.ajax({
                url: base_url + 'get_tax_dash',
                data: { 'pais': pais_origen },
                method: 'post',
                success: function(origen){
                    $('#loader').fadeOut('fast');
                    var str = JSON.parse(origen);
                    $('#diminutivoReceptor').val(str[0]['moneda']);
                    $.ajax({
                        url: 'get_tax_dash',
                        data: { 'pais': pais_beneficiario },
                        method: 'post',
                        success: function(beneficiario){
                            if( pais_origen == "Colombia" ){
                                var str2 = JSON.parse(beneficiario);
                                $('#diminutivoBeneficiario').val(str2[0]['moneda']);
                                $('#montoReceptor').on('keyup', function(){
                                    var montoReceptor = $('#montoReceptor').val(),
                                    total = montoReceptor / str[0]['tasa'];
                                    $('#montoBeneficiario').val(accounting.formatMoney(total, ""));
                                });
                            } else {
                                var str2 = JSON.parse(beneficiario);
                                $('#diminutivoBeneficiario').val(str2[0]['moneda']);
                                $('#montoReceptor').on('keyup', function(){
                                    var montoReceptor = $('#montoReceptor').val(),
                                    total = montoReceptor * str[0]['tasa'];
                                    $('#montoBeneficiario').val(accounting.formatMoney(total, ""));
                                });
                            }
                        }
                    });
                    
                }
        });
    });

    // Para Actualizar Tasas

        $('#selectPais').change(function(){
            var pais = $('#selectPais').val();
            if( pais != "false" ){
                $.ajax({
                    url: base_url + 'consulta_tasa',
                    data: {'pais': pais},
                    method: 'post',
                    beforeSend: function(){
                        $('#loader').fadeIn('fast');
                    },
                    success: function(result){
                        var str2 = JSON.parse(result);
                        $('#Tasa').val(str2['tasa']);
                        $('#loader').fadeOut('fast');
                    }
                });
            }
        });

        $('#actualizarTasas').on('submit', function(){
            event.preventDefault();
            var data = $('#actualizarTasas').serialize();
            $.ajax({
                url: base_url + 'actualizar_tasa',
                data: data,
                method: 'post',
                beforeSend: function(){
                    $('#loader').fadeIn('fast');
                },
                success: function(result){
                    if( result == "true" ){
                        $.notify({icon: "ti-info",message: "Cambios procesados exitosamente"},{type: "success",timer: 10000});
                    } else {
                        $.notify({icon: "ti-info",message: "Ocurrió un error, por favor intente mas tarde"},{type: "warning",timer: 10000});
                    }
                    $('#loader').fadeOut('fast');
                }
            });
        });

        // Misc

        $('#ActLoader').on('click', function(){
            $('#loader').fadeIn('fast')
        });

        $('#borraLoad').on('click', function(){
            $('#loader').fadeIn('fast')
        });

        // Para los pedidos

        $('#paisCuentaReceptor').on('change', function(){
            $('#loader').fadeIn('fast');
            $('#CuentasAdmin option[update="yes"]').remove();
            var data = $('#paisCuentaReceptor').val();
            if( data != 'false' ){
                
                $.getJSON( base_url + 'buscar_banco_admin_pais?a='+data,function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $("#CuentasAdmin").append('<option update="yes" value="'+banco.id+'">'+banco.banco+'</option>');
                        } else {
                            $("#CuentasAdmin").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            } else {
                $('#loader').fadeOut('fast');
            }
        });

        $('#laMoneda').on('change', function(){
            $('#loader').fadeIn('fast');
            var data = $('#laMoneda').val();
            if( data != 'false' ){
                
                $.getJSON( base_url + 'buscar_banco_admin_pais?a='+data,function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $('#diminutivoReceptor').val(banco.diminutivo);
                            $('#diminutivo_receptor').val(banco.diminutivo);
                        } else {
                            $('#diminutivoReceptor').val('');
                            $('#diminutivo_receptor').val('');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            } else {
                $('#loader').fadeOut('fast');
                $('#diminutivoReceptor').val('');
            }
        });

        $('#montoPagado').keyup(function(){
            if( $('#laMoneda').val() != "false" ){
                var str = $('#montoPagado').val();
                if( str.length == 0 ){
                    $('#montoBeneficiario').css('background-color', '#EEE');
                    $('#montoBeneficiario').css('color', '#444');
                } else {
                    $('#montoBeneficiario').css('background-color', '#7AC29A');
                    $('#montoBeneficiario').css('color', '#FFF');
                }
                var data = $('#paisBeneficiario').val(),
                    pais_pago = $('#laMoneda').val();
                $.ajax({
                    url: base_url + 'calcula_monto_pedido',
                    data: {'pais': pais_pago},
                    method: 'post',
                    success: function(taxReceptor){          
                        $.ajax({
                            url: base_url + 'calcula_monto_pedido',
                            data: {'pais': data},
                            method: 'post',
                            success: function(tasaBeneficiaria){
                                if( pais_pago == "Colombia" ){
                                    var str = $('#montoPagado').val(),
                                        pagado = parseFloat(str),
                                        taxRec = JSON.parse(taxReceptor),
                                        tasaRec = parseFloat(taxRec[0]['tasa']),
                                        total = pagado / tasaRec,
    
                                        totalFix = total.toFixed(2);
                                            
                                    $('#montoBeneficiario').val(accounting.formatMoney(totalFix, " "));
                                    $('#montoBeneficiarioHidden').val(totalFix);
                                } else {
                                    var str = $('#montoPagado').val(),
                                        pagado = parseFloat(str),
                                        taxRec = JSON.parse(taxReceptor),
                                        tasaRec = parseFloat(taxRec[0]['tasa']),
                                        total = pagado * tasaRec,
    
                                        totalFix = total.toFixed(2);
                                            
                                    $('#montoBeneficiario').val(accounting.formatMoney(totalFix, " "));
                                    $('#montoBeneficiarioHidden').val(totalFix);
                                }

                            }
                        });
                    }
                });
            }
        });

        $('#paisBeneficiario').on('change', function(){
            $('#loader').fadeIn('fast');
            $('#cuentaBeneficiaria option[update="yes"]').remove();
            $('#segundaCuentaBen option[update="yes"]').remove();
            $('#terceraCuentaBen option[update="yes"]').remove();
            $('#cuartaCuentaBen option[update="yes"]').remove();
            $('#quintaCuentaBen option[update="yes"]').remove();
            var data = $('#paisBeneficiario').val(),
                pais_pago = $('#paisCuentaReceptor').val();
            if( data != 'false' ){
                $.getJSON( base_url + 'buscar_banco_cliente?a='+data,function(result){
                    $.each(result, function(id,banco,alias){
                        $("#cuentaBeneficiaria").append('<option update="yes" value="'+banco.id+'">'+banco.banco+' - '+banco.alias+'</option>');
                        $("#segundaCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+' - '+banco.alias+'</option>');
                        $("#terceraCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+' - '+banco.alias+'</option>');
                        $("#cuartaCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+' - '+banco.alias+'</option>');
                        $("#quintaCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+' - '+banco.alias+'</option>');

                        $('#diminutivoBeneficiario').val(banco.diminutivo);
                        $.ajax({
                            url: base_url + 'calcula_monto_pedido',
                            data: {'pais': pais_pago},
                            method: 'post',
                            success: function(taxReceptor){       
                                $.ajax({
                                    url: base_url + 'calcula_monto_pedido',
                                    data: {'pais': banco.pais},
                                    method: 'post',
                                    success: function(tasaBeneficiaria){
                                        if( pais_pago == "Colombia" ){
                                            var str = $('#montoPagado').val(),
                                                pagado = parseFloat(str),
                                                taxRec = JSON.parse(taxReceptor),
                                                tasaRec = parseFloat(taxRec[0]['tasa']),
                                                total = pagado / tasaRec,
    
                                                totalFix = total.toFixed(2);
                                            
                                            $('#montoBeneficiario').val(accounting.formatMoney(totalFix, " "));
                                            $('#montoBeneficiarioHidden').val(totalFix);
                                        } else {
                                            var str = $('#montoPagado').val(),
                                                pagado = parseFloat(str),
                                                taxRec = JSON.parse(taxReceptor),
                                                tasaRec = parseFloat(taxRec[0]['tasa']),
                                                total = pagado * tasaRec,
    
                                                totalFix = total.toFixed(2);
                                            
                                            $('#montoBeneficiario').val(accounting.formatMoney(totalFix, " "));
                                            $('#montoBeneficiarioHidden').val(totalFix);
                                        }
                                        $('#loader').fadeOut('fast');
                                    }
                                });
                            }

                        });
                    });
                });
            }
        });

        $('#primeraCuentaBtn').on('click', function(){
            event.preventDefault();
            $('#primeraCuenta').slideDown('fast');
            $('#primeraCuentaBtnDiv').slideUp('fast');
        });

        $('#terceraCuentaBtn').on('click', function(){
            event.preventDefault();
            $('#terceraCuenta').slideDown('fast');
            $('#terceraCuentaBtnDiv').slideUp('fast');
        });

        $('#cuartaCuentaBtn').on('click', function(){
            event.preventDefault();
            $('#cuartaCuenta').slideDown('fast');
            $('#cuartaCuentaDiv').slideUp('fast');
        });

        $('#quintaCuentaBtn').on('click', function(){
            event.preventDefault();
            $('#quintaCuenta').slideDown('fast');
            $('#quintaCuentaBtnDiv').slideUp('fast');
        });



        // Terminan pedidos

        $('#passwordBtn').on('click', function(){
            $('#Perfil').css('display', 'none');
            $('#Password').css('display', 'initial');
            $('#perfilBtn').removeClass('active');
            $('#passwordBtn').addClass('active');
        });

        $('#perfilBtn').on('click', function(){
            $('#Perfil').css('display', 'initial');
            $('#Password').css('display', 'none');
            $('#perfilBtn').addClass('active');
            $('#passwordBtn').removeClass('active');
        });

        $('#agregarCuentaBtn').on('click', function(){
            $('#agregarCuenta').slideUp('fast');
            $('#agregarCuentaForm').slideDown('fast');
        });

        $('#bancosBtn').on('click', function(){
            $('#bancos').removeClass('display-none');
            $('#paises').addClass('display-none');
            $('#registrarPaisForm').addClass('display-none');
            $('#registrarBancoForm').removeClass('display-none');
            $('#paisesBtn').removeClass('active');
            $('#bancosBtn').addClass('active');
        });

        $('#paisesBtn').on('click', function(){
            $('#paises').removeClass('display-none');
            $('#registrarPaisForm').removeClass('display-none');
            $('#registrarBancoForm').addClass('display-none');
            $('#bancos').addClass('display-none');
            $('#bancosBtn').removeClass('active');
            $('#paisesBtn').addClass('active');
        });

        $('#paisBancoSeleccion').change(function(){
            $('#bancoSeleccionCrear option[update="yes"]').remove();
            var data = $('#paisBancoSeleccion').val();
            if( data != 'false' ){
                $.getJSON( base_url + 'buscar_banco_pais?a='+data,function(result){
                    $.each(result, function(id,banco){
                        $("#bancoSeleccionCrear").append('<option update="yes" value="'+banco.banco+'">'+banco.banco+'</option>');
                    });
                });
            }
        });

        $.validate({
            form: '#agregarCuentaNueva',
            validateOnBlur: false,
            onValidate: function(){
                $('#loader').fadeIn('fast');
                var banco = $('#bancoSeleccion').val(),
                    tipoCi = $('#tipoCi').val();

                if( banco == "false" ){
                    event.preventDefault();
                    $('#bancoErr').html('Campo requerido');
                    $('#bancoSeleccion').addClass('border-is-danger');
                    $('#loader').fadeOut('fast');
                } else {
                    $('#bancoSeleccion').removeClass('border-is-danger');
                    $('#bancoErr').html('');
                }

                if( tipoCi == "false" ){
                    event.preventDefault()
                    $('#tipoCi').addClass('border-is-danger');
                    $('#loader').fadeOut('fast');
                } else {
                    $('#tipoCi').removeClass('border-is-danger');
                }
                
                if( banco == "Otros" ){
                    var bancoAlt = $('#banco_alt').val();
                    if( bancoAlt.length == 0 ){
                        event.preventDefault();
                        $('#banco_altErr').html('<i class="ti-info-alt"></i>&nbsp;Campo requerido');
                        $('#banco_alt').addClass('border-is-danger');
                        $('#loader').fadeOut('fast');
                    } else {
                        $('#banco_alt').removeClass('border-is-danger');
                        $('#banco_altErr').html('');
                    }
                }
                
            },
        });

        $.validate({
            form: '#registrarBanco',
            onValidate: function(){
                var pais = $('#paisBanco').val();

                if( pais == "false" ){
                    event.preventDefault();
                    $('#loader').removeClass('show-loader');
                    $('#paisBancoErr').html('Campo Requerido');
                    $('#paisBanco').addClass('border-danger');
                  } else {
                    $('#paisBancoErr').html('');
                    $('#paisBanco').removeClass('border-danger');
                  }
                  
            },
            onError: function(){

            }
        })

        $('#primerMonto').click( function(){
            $('#primerMonto').val('');
        });

        $('#segundoMonto').click( function(){
            $('#segundoMonto').val('');
        });

        $('#tercerMonto').click( function(){
            $('#tercerMonto').val('');
        });

        $('#cuartoMonto').click( function(){
            $('#cuartoMonto').val('');
        });

        $('#quintoMonto').click( function(){
            $('#quintoMonto').val('');
        });

        // Formulario de pedido

        $.validate({
            form: '#pedidoForm',
            modules: 'file',
            validateOnBlur: false,
            onValidate: function(){
                
                var form1 = $('#paisCuentaReceptor').val(),
                    form2 = $('#CuentasAdmin').val(),
                    form3 = $('#paisBeneficiario').val(),
                    form4 = $('#cuentaBeneficiaria').val(),
                    form5 = $('#laMoneda').val(),
                    monto1 = parseFloat($('#primerMonto').val()),
                    monto2 = parseFloat($('#segundoMonto').val()),
                    monto3 = parseFloat($('#tercerMonto').val()),
                    monto4 = parseFloat($('#cuartoMonto').val()),
                    monto5 = parseFloat($('#quintoMonto').val()),
                    total = monto1 + monto2 + monto3 + monto4 + monto5,
                    totalFix = parseFloat(total),
                    montoBen = parseFloat($('#montoBeneficiarioHidden').val());

                    var resp = false, resp2 = false, resp3 = false; resp4 = false, resp5 = false, resp6 = false, resp7 = false;

                    if( form1 == "false" ){
                        event.preventDefault();
                        $('#paisCuentaReceptor').addClass('border-is-danger');
                        $('#paisCuentaReceptorErr').html('<i class="ti-info-alt"></i>&nbsp;Campo requerido');
                        resp = false;
                    } else {
                        $('#paisCuentaReceptor').removeClass('border-is-danger');
                        $('#paisCuentaReceptorErr').html('');
                        resp = true;
                    }

                    if( form2 == "false" ){
                        event.preventDefault();
                        $('#CuentasAdminErr').html('<i class="ti-info-alt"></i>&nbsp;Campo requerido');
                        $('#CuentasAdmin').addClass('border-is-danger');
                        resp2 = false;
                    } else {
                        $('#CuentasAdmin').removeClass('border-is-danger');
                        $('#CuentasAdminErr').html('');
                        resp2 = true;
                    }

                    if( form3 == "false" ){
                        event.preventDefault();
                        $('#paisBeneficiarioErr').html('<i class="ti-info-alt"></i>&nbsp;Campo requerido');
                        resp3 = false;
                    } else {
                        $('#paisBeneficiarioErr').html('');
                        resp3 = true;
                    }

                    if( form4 == "false" ){
                        event.preventDefault();
                        $('#cuentaBeneficiariaErr').html('<i class="ti-info-alt"></i>&nbsp;Se requiera al menos una cuenta');
                        $('#cuentaBeneficiaria').addClass('border-is-danger');
                        resp4 = false;
                    } else {
                        $('#cuentaBeneficiariaErr').html('');
                        $('#cuentaBeneficiaria').removeClass('border-is-danger');
                        resp4 = true;
                    }

                    if( form5 == "false" ){
                        event.preventDefault();
                        $('#laMoneda').addClass('border-is-danger');
                        $('#laMonedaErr').html('<i class="ti-info-alt"></i>&nbsp;Campo requerido');
                        resp5 = false;
                    } else {
                        $('#laMoneda').removeClass('border-is-danger');
                        $('#laMonedaErr').html('');
                        resp5 = true;
                    }

                    if( monto1 == 0 ){
                        event.preventDefault();
                        $('#primerMonto').addClass('border-is-danger');
                        $('#primerMontoErr').html('<i class="ti-info-alt"></i>&nbsp;Obligatorio');
                        resp6 = false;
                    } else {
                        $('#primerMonto').removeClass('border-is-danger');
                        $('#primerMontoErr').html('');
                        resp6 = true;
                    }
                    
                    if( totalFix > montoBen ){
                        event.preventDefault();
                        var montoErr = totalFix - montoBen;
                        $('#sumatoriaErr').html('<div class="animated shake alert alert-danger"><i class="ti-info-alt"></i>&nbsp;El monto se excede por ' + accounting.formatMoney( montoErr, "" ) + '</div>' );
                        resp7 = false;   
                    } else if( totalFix < montoBen ){
                        event.preventDefault();
                        var montoErr = montoBen - totalFix;
                        $('#sumatoriaErr').html('<div class="animated shake alert alert-danger"><i class="ti-info-alt"></i>&nbsp;El monto está por debajo por ' + accounting.formatMoney( montoErr, "" ) + '</div>' );
                        resp7 = false;
                    } else if( totalFix == montoBen ){
                        $('#sumatoriaErr').html('');
                        resp7 = true;
                    }

                    if( resp == true && resp2 == true && resp3 == true && resp4 == true && resp5 == true && resp6 == true && resp7 == true ){
                        var confirmation = confirm('Está por registrar un pedido ¿Los datos ingresados son correctos?');
                        if( confirmation === false ){
                            event.preventDefault();
                        }
                    }
                    
                },
        });

        $('#reportarPagoBtn').click(function(){
            $('#reportarPago').removeClass('display-none');
            $('#pedidosContent').addClass('display-none');
            $('#pedidosBtn').removeClass('active');
            $('#reportarPagoBtn').addClass('active');
            $('#pagoBancos').removeClass('display-none');
        });

        $('#pedidosBtn').click(function(){
            $('#reportarPago').addClass('display-none');
            $('#pedidosContent').removeClass('display-none');
            $('#reportarPagoBtn').removeClass('active');
            $('#pedidosBtn').addClass('active');
            $('#pagoBancos').addClass('display-none');
        });

        $('#closeModalBtn').click(function(){
            $('#modalWindow').fadeOut('fast');
        });

    $('#actualizarTasas').on('click', function(){
        $('[id="actualizarTasasForm"]').each(function(){
            var data = $(this).serialize();
            $.ajax({
                url: base_url + 'actualizar_tasa',
                data: data,
                method: 'post',
                beforeSend: function(){
                    $('#loader').fadeIn('fast');
                },
                success: function(result){
                    $('#loader').fadeOut('fast');
                }
            });
        });
    });

    $('#rechazarBtn').click(function(){
        $('#rechazarContent').removeClass('display-none');
    });

    $('#closeVerificacionBtn').click(function(){
        $('#rechazarContent').addClass('display-none');
    });
    
    $('[data-open-new="true"]').each(function(){
        $(this).click(function(){
            var data = $(this).val();
            $('#whichCuenta').val(data);
            $('#nuevaCuentaPedidos').removeClass('display-none');
        });
    });

    $('#closeNuevaCuentaPedidos').click(function(){
        $('#nuevaCuentaPedidos').addClass('display-none');
    });

    $('#bancoSeleccionCrear').on('change', function(){
        var banco = $('#bancoSeleccionCrear').val();
        if( banco == "Otros" ){
            $('#bancoAlt').css('display', 'initial');
        } else {
            $('#bancoAlt').css('display', 'none');
        }
    });

    $('[data-reset-cuenta="true"]').each(function(){
        $(this).click(function(){
            var data = $(this).val();
            if( data == "cuenta1" ){
                $('#newElement').html('<select name="primera_cuenta" class="custom-input" id="cuentaBeneficiaria"><option value="false"></option></select>');
                $.getJSON( base_url + 'get_usuarios_cuenta',function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $("#cuentaBeneficiaria").append('<option update="yes" value="'+banco.id+'">'+banco.banco+'</option>');
                        } else {
                            $("#cuentaBeneficiaria").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            } else if( data == "cuenta2" ) {
                $('#newElement1').html('<select name="segunda_cuenta" class="custom-input" id="segundaCuentaBen"><option value="false"></option></select>');
                $.getJSON( base_url + 'get_usuarios_cuenta',function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $("#segundaCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+'</option>');
                        } else {
                            $("#segundaCuentaBen").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            } else if( data == "cuenta3" ) {
                $('#newElement2').html('<select name="tercera_cuenta" class="custom-input" id="terceraCuentaBen"><option value="false"></option></select>');
                $.getJSON( base_url + 'get_usuarios_cuenta',function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $("#terceraCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+'</option>');
                        } else {
                            $("#terceraCuentaBen").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            } else if( data == "cuenta4" ) {
                $('#newElement3').html('<select name="cuarta_cuenta" class="custom-input" id="cuartaCuentaBen"><option value="false"></option></select>');
                $.getJSON( base_url + 'get_usuarios_cuenta',function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $("#cuartaCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+'</option>');
                        } else {
                            $("#cuartaCuentaBen").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            } else if( data == "cuenta5" ) {
                $('#newElement4').html('<select name="quinta_cuenta" class="custom-input" id="quintaCuentaBen"><option value="false"></option></select>');
                $.getJSON( base_url + 'get_usuarios_cuenta',function(result){
                    $.each(result, function(id,banco){
                        if( result.error != "true"){
                            $("#quintaCuentaBen").append('<option update="yes" value="'+banco.id+'">'+banco.banco+'</option>');
                        } else {
                            $("#quintaCuentaBen").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            }
            $(this).addClass('display-none-imp');
        });
    });

    $.validate({
        form: '#addCuentaSeccionPedidos',
        validateOnBlur: false,
        onValidate: function(){
            $('#loader').fadeIn('fast');
            var banco = $('#bancoSeleccionCrear').val();

            if( banco == "Otros" ){
                var banco_alt = $('#banco_alt').val();
                if( banco_alt.length == 0 ){
                    event.preventDefault();
                    $('#bancoalt').html('Campo Requerido');
                    $('#banco_alt').addClass('border-danger');
                    $('#loader').fadeOut('fast');        
                } else {
                    $('#bancoalt').html('');
                    $('#banco_alt').removeClass('border-danger');
                }
            }

            if( banco == "false" ){
                event.preventDefault();
                $('#bancoErr').html('Campo Requerido');
                $('#bancoSeleccionCrear').addClass('border-danger');
                $('#loader').fadeOut('fast');
            } else {
                $('#bancoErr').html('');
                $('#bancoSeleccionCrear').removeClass('border-danger');
            }

        },
        onError: function(){
            $('#loader').fadeOut('fast');
        },
        onSuccess: function(){
            event.preventDefault();
            var confirmation = confirm('¿Los datos ingresados son correctos?');
            if( confirmation ){
                var data = $('#addCuentaSeccionPedidos').serialize();
                $.ajax({
                    url: base_url + 'addBanco',
                    data: data,
                    method: 'post',
                    success: function(result){
                        var str = JSON.parse(result);
                        if( str.status == "OK" ){
                            $('#nuevaCuentaPedidos').addClass('display-none');
                            $('[data-cuenta-input="true"]').val('');
                            var thisCuenta = $('#whichCuenta').val();
                                if( thisCuenta == "cuenta1" ){
                                    $('#cuentaBeneficiaria').remove();
                                    $('#newElement').append('<input type="hidden" name="primera_cuenta" value="' + str.id_cuenta + '"><input type="text" disabled class="custom-input" value="' + str.alias + '">');
                                    $('#resetearCuenta').removeClass('display-none-imp');
                                } else if( thisCuenta == "cuenta2" ) {
                                    $('#segundaCuentaBen').remove();
                                    $('#newElement1').append('<input type="hidden" name="segunda_cuenta" value="' + str.id_cuenta + '"><input type="text" disabled class="custom-input" value="' + str.alias + '">');
                                    $('#resetearCuenta1').removeClass('display-none-imp');
                                } else if( thisCuenta == "cuenta3" ){
                                    $('#terceraCuentaBen').remove();
                                    $('#newElement2').append('<input type="hidden" name="tercera_cuenta" value="' + str.id_cuenta + '"><input type="text" disabled class="custom-input" value="' + str.alias + '">');
                                    $('#resetearCuenta2').removeClass('display-none-imp');
                                } else if( thisCuenta == "cuenta4" ){
                                    $('#cuartaCuentaBen').remove();
                                    $('#newElement3').append('<input type="hidden" name="cuarta_cuenta" value="' + str.id_cuenta + '"><input type="text" disabled class="custom-input" value="' + str.alias + '">');
                                    $('#resetearCuenta3').removeClass('display-none-imp');
                                } else if( thisCuenta == "cuenta5" ){
                                    $('#quintaCuentaBen').remove();
                                    $('#newElement4').append('<input type="hidden" name="quinta_cuenta" value="' + str.id_cuenta + '"><input type="text" disabled class="custom-input" value="' + str.alias + '">');
                                    $('#resetearCuenta4').removeClass('display-none-imp');
                                }
                        }
                        $('#loader').fadeOut('fast');
                    }
                });
            } else {
                $('#loader').fadeOut('fast');
            }
        }
    });

    // Cuentas Bancarias

    $('#bancoSeleccion').on('change', function(){
        if( $(this).val() == "Otros" ){
            $('#bancoAlt').removeClass('display-none');
        } else {
            $('#bancoAlt').addClass('display-none');
        }
    });

    // Pedido Manager

    $('#status').on('change', function(){
        var status = $('#status').val();
        if( status == 2 ){
            $('#motivo').removeClass('display-none');
        } else {
            $('#motivo').addClass('display-none');
        }
    });


    $.validate({
        form: '#otrosForm',
        validateOnBlur: false,
        onSuccess: function(){
            var data = $('#otrosForm').serialize();
            $.ajax({
                url: base_url + 'registrar_cuenta_otros',
                data: data,
                method: 'post',
                beforeSend: function(){
                    $('#loader').fadeIn('fast');
                },
                success: function(result){
                    if( result == "true" ){
                        location.href = base_url + "cuentas_bancarias_admin?msg=1";
                    } else {
                        location.href = base_url + "cuentas_bancarias_admin?msg=2";
                    }
                }
            });
        }
    });

    $('#cuentaBancariaBtn').click(function(){
        $( this ).addClass('active');
        $('#cuentaBancariaContent').removeClass('display-none');
        $('#otrosBtn').removeClass('active');
        $('#otrosContent').addClass('display-none');
    });

    $('#otrosBtn').click(function(){
        $( this ).addClass('active');
        $('#otrosContent').removeClass('display-none');
        $('#cuentaBancariaBtn').removeClass('active');
        $('#cuentaBancariaContent').addClass('display-none');
    });



});