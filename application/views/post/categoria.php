<select name="categoria" id="categoria" class="result-categoria">
    <option value="">Seleccione una Categoría</option>
    <?php
        foreach($categorias->result() as $categoria)
        {
            echo '<option value="'.$categoria->idCategorias.'">'.$categoria->nombre.'</option>';
        }
    ?>
</select>