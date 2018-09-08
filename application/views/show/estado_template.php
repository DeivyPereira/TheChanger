<?php if( $estado_cuenta != FALSE ): ?>
<?php foreach( $estado_cuenta as $estado ): ?>
<tr>
    <td><?= $estado['fecha']; ?></td>
    <td><?= $estado['descripcion']; ?></td>
    <td class="text-success"><?= number_format( $estado['monto_variable'], 2 ); ?></td>
    <td>
        <?= number_format( $estado['monto'], 2 ); ?>&nbsp;
        <?= $admin_banco->diminutivo; ?>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td>
        <i class="ti-info-alt"></i>
        No existen registros para la fecha seleccionada
    </td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<?php endif; ?>