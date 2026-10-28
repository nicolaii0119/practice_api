<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - App Dev</title>
    <?php include_once('Components/Includes.php'); ?>
</head>
<body>
    <?php
    if(isset($_POST['login'])){
        $idnum = $_POST['idnum'];
        $password = $_POST['password'];
        $op = 'login';

        $data = [
            'idnum' => $idnum,
            'password' => $password,
            'op' => $op
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://practice-api-haux.onrender.com/Request/User.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($response, true);

        if ($result && isset($result['success']) && $result['success'] == true) {
            header("Location: Index.php");
            exit();
        } else {
            if (isset($result['icon'])) {
                $icon = $result['icon'];
            } else {
                $icon = 'error';
            }

            if (isset($result['message'])) {
                $message = $result['message'];
            } else {
                $message = 'Invalid server connection.';
            }

            echo "<script>
                Swal.fire({
                    icon: '".$icon."',
                    title: 'Error',
                    text: '".$message."'
                });
            </script>";
        }
    }
    ?>
    <form method="POST">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-4 p-4 shadow border rounded">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>ID Number<i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="idnum" id="idnum" placeholder="Enter your ID Number" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Password<i class="text-danger">*</i></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control" name="login" id="login">Log In</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>