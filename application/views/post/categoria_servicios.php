<select name="categoria2" id="categoria2" class="result-categoria">
    <option value="">Seleccione una Categoría</option>
    <?php
        foreach($categorias->result() as $categoria)
        {
            echo '<option value="'.$categoria->idCategorias.'">'.$categoria->nombre.'</option>';
        }
    ?>
</select>