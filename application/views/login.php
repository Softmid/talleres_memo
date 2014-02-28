<section id="contenedorLogin">
	<form id="formLogin" action="index.php/login/validarLogin" method="post">
        <ul id="datos">
            <li><h2>Login <span>>></span></h2></li>
            <li><input type="text" class="login" value="<? echo $this->input->post('usuario'); ?>" name="usuario" id="usuario" placeholder="Usuario"/></li>
            <li><input type="password" class="login" name="password" id="password" placeholder="Contrase&ntilde;a" /></li>
            <li><input type="submit" id="btnLogin" name="btnLogin" value="Entrar"/></li>
            <li><? echo validation_errors('<span class="login-error">', '</span>'); ?></li>
        </ul>
    </form>
</section>



