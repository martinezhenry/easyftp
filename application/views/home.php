
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once 'global/head.php'; ?>

        <script src="assets/js/JQueryRC4.js"></script>
        <script src="assets/js/jquery.base64.min.js"></script>
        <script src="assets/js/jquery.md5.js"></script>
        <script src="assets/js/tahc.js"></script>

    </head>

    <body>
        <div class="container">
            <?php require_once 'global/header.php'; ?>
            <div class="body caja">
                <form id='form-login'>
                    <div>
                        <p>Usuario</p> <input name='user' type="text" />
                    </div>
                    <div>
                        <p>Clave</p> <input name="clave" type="password" />
                    </div>
                    <input type="submit"/>
                </form>
                <form name="form-msg">
                    <div><span>Usuario:</span> <b><i id='user-label'></i></b> <i><a id="logout" href="#">Salir</a></i> <input id = "user-cod" type="hidden" /></div>
                    <div><p>key</p> <input required="" name="yek" type="password" /> <a id="onkey" href="#">Establecer llave</a></div>
                    <div id="tahc"></div>
                    <div><p>Message</p> <input name="msg" type="text" /></div>
                    <input type="submit" value="enviar"/>
                </form>

                <div id="ot"><a id="addUser" href="#">add User</a>
                    <a id="deleteUser" href="#">delete User</a>
                    <a id="updateUser" href="#">update User</a></div>

            </div>
            <?php require_once 'global/footer.php'; ?>
        </div>
    <msg-per></msg-per>
    <yek-id></yek-id>
</body>



</html>