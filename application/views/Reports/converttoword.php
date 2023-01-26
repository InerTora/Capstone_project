<!DOCTYPE html>
<html>

<head>
    <title>Conver Number to Words in PHP</title>
</head>

<body>
    <form method="post">
        <table border="0" align="center">
            <tr>
                <td>Enter Your Numbers</td>
                <input type="text" name="num" value="4523">

                <?php 
              
                if(isset($num))
                {
                    echo $num
                
                ;}?>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Conver Number to Words" name="convert" />
                </td>
            </tr>
        </table>
    </form>

</body>

</html>