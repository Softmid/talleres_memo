<?php
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y');
?>
 <footer>
    	<p>Copyright (c) <? echo $dateTime; ?>  Softmid todos los derechos reservados.</p>
 </footer>

</body>
</html>