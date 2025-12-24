
************************fail1***************************************
<html>
<body>
<?php
            extract($_POST);
            $conn=mysqli_connect("localhost","root","","mycompany")or die("Couldn't connect
    to server");
    if (mysqli_connect_errno()) #if connection fails throw an error
    echo "could not connect to databse :Error:".mysqli_connect_error();
    if(isset($_POST["del"]))
        { $querydel="delete from emp where Salary > 100";
        $delresult = mysqli_query($conn,$querydel)
        or die("Query del faild:".mysqli_error($conn));
        echo mysqli_affected_rows($conn)." record/s is/are deleted";
    }
    if(isset($_POST["ins"]))
    {
        $queryins="insert into emp (Empno,Ename,Address,Salary, deptno)
        values ($empno ,'$name','$add' ,$sal,$deptno )";
        $insresult = mysqli_query($conn,$queryins)
        or die("Query ins faild:".mysqli_error($conn));
        echo mysqli_affected_rows($conn)." record inserted";
    }
    if(isset($_POST["upd"]))
    {
        $querydel="Salary=Salary+10";
        $delresult = mysqli_query($conn,$querydel);
    }
?>
<body></html>

