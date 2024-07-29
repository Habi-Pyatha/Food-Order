<?php include('partials-front/menu.php');?>
<style>
    *{
        margin:0;
        padding:0;
    }
    body{
        background:#55ffe5;
        font-size:14px;

    }
    .navbar{
        background:white;
    }
    .contact-box
    {
        background:#fff;
        display:flex;
    }
    .contact-left{
        flex-basis:60%;
        padding:40px 60px;
    }
    .contact-right{
        flex-basis:40%;
        padding:40px;
        background:#1c00b5;
        color:#fff;
    }
    .container3{
        width:80%;
        margin:50px auto;
    }
    h1{
        margin-bottom:10px;
    }
    .container3 p{
        margin-bottom:40px;
    }
    
    .input-row{
        display: flex;
        justify-content:space-between;
        margin-bottom:20px;
    }
    .input-row .input-group{
        flex-bais:45%;
    }
    input{
        width:100px;
        border:none;
        border-bottom:1px solid #ccc;
        outline:none;
        padding-bottom:5px;
    }
    /* .input-row{
        display:flex;
    } */
    textarea{
        width:100%;
        border:1px solid #ccc;
        outline:none;
        padding:10px;
        box-sizing:border-box;

    }
    label{
        margin-bottom:6px;
        display:block;
        color:#1c00b5;
    }
button{
    background:#1c00b5;
    width:100px;
    border:none;
    outline:none;color:#fff;
    height:35px;
    border-radius:30px;
    box-shadow:0px 5px 15px 0px rgba(28,0,181,0.3);
    margin-top:20px;
}
.contact-left h3{
    color:#1c00b5;
    font-weight:600;
    margin-bottom:30px;
}
.contact-right h3{
   
    font-weight:600;
    margin-bottom:30px;
}
tr td:first-child{
    padding-right:20px;
}
tr td{
    padding-top:20px;
}
</style>

<div class="container3">


        <h1>Connect with Us</h1>
        <p>
            We would love to respond to your queries and help you feel satisfied. <br> Feel free to get in touch with us.
        </p>
        <div class="contact-box">
            <div class="contact-left">
                <h3>Sent your request</h3>
                <br><br>
                <form action="">
                    <div class="input-row">
                        <div class="input-group">
                            <label >
                                Name
                            </label>
                            <input type="text" placeholder="Habi Pyatha">
                        </div>
                        <!-- <div class="input-group">
                            <label >
                                Phone
                            </label>
                            <input type="text" placeholder="7766 554 87">
                        </div> -->
                        <div class="input-row">
                            <div class="input-group">
                                <label >
                                    Email
                                </label>
                                <input type="email" placeholder="pyatha@gmail.com">
                            </div>
                        </div>
                            <div class="input-row">

                                <div class="input-group">
                                    <label >
                                        Food
                                    </label>
                                <input type="text" placeholder="Food Name">
                            </div>
                        </div>
                    </div>
                    <label >
                        Message
                    </label>
                    <textarea name="" id="" cols="50" rows="5"></textarea>
                  <button type="submit">Send</button>
                </form>
            </div>
            <div class="contact-right">
                <h3>Reach Us</h3>
                <table>
                    <tr>
                        <td>Email:</td>
                        <td>GoodFoods@food.com</td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td>66779900</td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td>JO JO Nyit koels <br> Bhaktapur , Nepal</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php include('partials-front/footer.php');?>