$(document).ready(function(){
            
    var base_url = 'http://localhost/cexpress/';

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
                            $('#diminutivoReceptor').val(banco.diminutivo);
                        } else {
                            $("#CuentasAdmin").append('<option update="yes" value="false">No hay cuentas registradas</option>');
                        }
                        $('#loader').fadeOut('fast');
                    });
                });
            }
        });

        $('#montoPagado').keyup(function(){
            if( $('#paisBeneficiario').val() != "false" ){
                var data = $('#paisBeneficiario').val(),
                    pais_pago = $('#paisCuentaReceptor').val();
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
                var banco = $('#bancoSeleccionCrear').val();
                if( banco == "false" ){
                    event.preventDefault();
                    $('#bancoErr').html('Campo requerido');
                }
            },
            onSuccess: function(){
                $('#loader').fadeIn('fast');
            }
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

        $.validate({
            form: '#pedidoForm',
            validateOnBlur: false,
            onValidate: function(){
                
                var form1 = $('#paisCuentaReceptor').val(),
                    form2 = $('#CuentasAdmin').val(),
                    form3 = $('#paisBeneficiario').val(),
                    form4 = $('#cuentaBeneficiaria').val(),
                    monto1 = parseFloat($('#primerMonto').val()),
                    monto2 = parseFloat($('#segundoMonto').val()),
                    monto3 = parseFloat($('#tercerMonto').val()),
                    monto4 = parseFloat($('#cuartoMonto').val()),
                    monto5 = parseFloat($('#quintoMonto').val()),
                    total = monto1 + monto2 + monto3 + monto4 + monto5,
                    totalFix = parseFloat(total),
                    montoBen = parseFloat($('#montoBeneficiarioHidden').val());

                    if( form1 == "false" ){
                        event.preventDefault();
                        $('#paisCuentaReceptorErr').html('Campo requerido');
                    } else {
                        $('#paisCuentaReceptorErr').html('');
                    }

                    if( form2 == "false" ){
                        event.preventDefault();
                        $('#CuentasAdminErr').html('Campo requerido');
                    } else {
                        $('#CuentasAdminErr').html('');
                    }

                    if( form3 == "false" ){
                        event.preventDefault();
                        $('#paisBeneficiarioErr').html('Campo requerido');
                    } else {
                        $('#paisBeneficiarioErr').html('');
                    }

                    if( form4 == "false" ){
                        event.preventDefault();
                        $('#cuentaBeneficiariaErr').html('Campo requerido');
                    } else {
                        $('#cuentaBeneficiariaErr').html('');
                    }

                    if( monto1.length == 0 ){
                        event.preventDefault();
                        $('#primerMontoErr').html('Campo requerido');
                    } else {
                        $('#primerMontoErr').html('');
                    }
                    
                    if( totalFix > montoBen ){
                        event.preventDefault();
                        var montoErr = totalFix - montoBen;
                        $('#sumatoriaErr').html('El monto se excede por ' + accounting.formatMoney( montoErr, "" ) );   
                    } else if( totalFix < montoBen ){
                        event.preventDefault();
                        var montoErr = montoBen - totalFix;
                        $('#sumatoriaErr').html('El monto está por debajo por ' + accounting.formatMoney( montoErr, "" ) );
                    } else if( totalFix == montoBen ){
                        $('#sumatoriaErr').html('');
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

    });