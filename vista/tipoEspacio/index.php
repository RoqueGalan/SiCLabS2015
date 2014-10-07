<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'tipoEspacio/nuevo'; ?>" class="btn btn-link">Nuevo Tipo Espacio</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Tipo de Espacio</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($this->listaTiposEspacio as $key => $permiso): ?>
            <tr>
                <td><?php echo $permiso->getNombre(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'tipoEspacio/editar/' . $permiso->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'tipoEspacio/mostrar/' . $permiso->getId(); ?>" >Mostrar</a> | 
                    <a href="<?php echo ROOT . 'tipoEspacio/eliminar/' . $permiso->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    
    
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>