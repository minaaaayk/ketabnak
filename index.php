<?php
/**
 * Created by PhpStorm.
 * User: Minaa
 * Date: 11/14/2019
 * Time: 8:59 PM
 */

// Create connection

?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css">
    <!-- jQuery library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/f9397d45e5.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
include ("db.php");
?>
<div id="main">
    <div id="head"></div>
    <div id="book-body">
        <div id="form-book">
            Add new book
            <form>
                <input type="text" placeholder="Book name" id="book-name">
                <input type="text" placeholder="Author name"id="author-name">
                <a href="#" id="add-book-btn">Add</a>
            </form>
        </div>
        <div id="show-book">
            List of Books
            <div id="books">
                <div class="book">
                    <div class="detail">
                        <div class="name">
                            Book 1
                        </div>
                        <div class="author">
                            author 1
                        </div>
                    </div>
                    <a class="remove" href="">
                        <img  class="remove-btn" src="times-circle-regular.svg" />
                    </a>
                </div>
                <div class="book">
                    <div class="detail">
                        <div class="name">
                            Book 2
                        </div>
                        <div class="author">
                            author 2
                        </div>
                    </div>
                    <a class="remove" href="">
                        <img  class="remove-btn" src="times-circle-regular.svg"  data-id=""/>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<!-- JQuery -->
<!--<script type="text/javascript" src="jquery-3.4.1.min.js"></script>-->
<script>
    $(document).ready(function() {

        $.ajax({
            url: 'book-manager.php',
            type: 'POST',data: {
                action : 3
            },
            cache: false,
            success: function(data){
                var dataResult = JSON.parse(data);
                $('#books').html(dataResult.content);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("No");
            }
        });

        $('#add-book-btn').on('click', function() {
            $("#add-book-btn").attr("disabled", "disabled");
            var bname = $('#book-name').val();
            var aname = $('#author-name').val();
            if(bname!="" && aname!=""){
                $.ajax({
                    url: "book-manager.php",
                    type: "POST",
                    data: {
                        action : 1,
                        bookname: bname,
                        auhorname: aname
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            $("#add-book-btn").removeAttr("disabled");
                            $('#book-name').val('');
                            $('#author-name').val('');
                            $('#books').html(dataResult.content);
                        }
                        else if(dataResult.statusCode==201){
                            alert("Error occured !");
                        }

                    }
                });
            }
            else{
                alert('Please fill all the field !');
            }
        });



        /*setTimeout(function(){
            $('#books .remove-btn').on('click', function() {

            });
        },2000);*/




    });

    function removeBook(evt,element,id) {
        evt.preventDefault();
        evt.stopPropagation();
        console.log(id);
        $.ajax({
            url: "book-manager.php",
            type: "POST",
            cache: false,
            data:{
                action : 2,
                id: id
            },
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#books').html(dataResult.content);
                }
            }
        });
    }
</script>

</body>
</html>