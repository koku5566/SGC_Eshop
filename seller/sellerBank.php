<?php
    require __DIR__ . '/header.php'
?>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:100%;">
<div class="card mt-50 mb-50">
    <div class="card-title mx-auto"> Bank Acccount </div>
    <div class="nav">
        <br>
    </div>
    <form> <span id="card-header">Saved cards:</span>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /></div>
            <div class="col-7"> <input type="text" placeholder="**** **** **** 3193"> </div>
            <div class="col-3 d-flex justify-content-center"> <a href="#">Remove card</a> </div>
        </div>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png" /></div>
            <div class="col-7"> <input type="text" placeholder="**** **** **** 4296"> </div>
            <div class="col-3 d-flex justify-content-center"> <a href="#">Remove card</a> </div>
        </div> <span id="card-header">Add new card:</span>
        <div class="row-1">
            <div class="row row-2"> <span id="card-inner">Card holder name</span> </div>
            <div class="row row-2"> <input type="text"> </div>
        </div>
        <div class="row three">
            <div class="col-7">
                <div class="row-1">
                    <div class="row row-2"> <span id="card-inner">Card number</span> </div>
                    <div class="row row-2"> <input type="text" placeholder="5134-5264-4"> </div>
                </div>
            </div>
            <div class="col-2"> <input type="text" placeholder="Exp. date"> </div>
            <div class="col-2"> <input type="text" placeholder="CVV"> </div>
        </div> <button class="btn d-flex mx-auto"><b>Add card</b></button>
    </form>
</div>
    </div>
    <!-- /.container-fluid -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>

<style>


.card {
    margin: auto;
    width: 900px;
    padding: 3rem 3.5rem;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

.mt-50 {
    margin-top: 50px
}

.mb-50 {
    margin-bottom: 50px
}

@media(max-width:767px) {
    .card {
        width: 90%;
        padding: 1.5rem
    }
}

@media(height:1366px) {
    .card {
        width: 90%;
        padding: 8vh
    }
}

.card-title {
    font-weight: 700;
    font-size: 2.5em
}

.nav {
    display: flex
}

.nav ul {
    list-style-type: none;
    display: flex;
    padding-inline-start: unset;
    margin-bottom: 6vh
}

.nav li {
    padding: 1rem
}

.nav li a {
    color: black;
    text-decoration: none
}

.active {
    border-bottom: 2px solid black;
    font-weight: bold
}

input {
    border: none;
    outline: none;
    font-size: 1rem;
    font-weight: 600;
    color: #000;
    width: 100%;
    min-width: unset;
    background-color: transparent;
    border-color: transparent;
    margin: 0
}

form a {
    color: grey;
    text-decoration: none;
    font-size: 0.87rem;
    font-weight: bold
}

form a:hover {
    color: grey;
    text-decoration: none
}

form .row {
    margin: 0;
    overflow: hidden
}

form .row-1 {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 0.5rem;
    outline: none;
    width: 100%;
    min-width: unset;
    border-radius: 5px;
    background-color: rgba(221, 228, 236, 0.301);
    border-color: rgba(221, 228, 236, 0.459);
    margin: 2vh 0;
    overflow: hidden
}

form .row-2 {
    border: none;
    outline: none;
    background-color: transparent;
    margin: 0;
    padding: 0 0.8rem
}

form .row .row-2 {
    border: none;
    outline: none;
    background-color: transparent;
    margin: 0;
    padding: 0 0.8rem
}

form .row .col-2,
.col-7,
.col-3 {
    display: flex;
    align-items: center;
    text-align: center;
    padding: 0 1vh
}

form .row .col-2 {
    padding-right: 0
}

#card-header {
    font-weight: bold;
    font-size: 0.9rem
}

#card-inner {
    font-size: 0.7rem;
    color: gray
}

.three .col-7 {
    padding-left: 0
}

.three {
    overflow: hidden;
    justify-content: space-between
}

.three .col-2 {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 0.5rem;
    outline: none;
    width: 100%;
    min-width: unset;
    border-radius: 5px;
    background-color: rgba(221, 228, 236, 0.301);
    border-color: rgba(221, 228, 236, 0.459);
    margin: 2vh 0;
    width: fit-content;
    overflow: hidden
}

.three .col-2 input {
    font-size: 0.7rem;
    margin-left: 1vh
}

.btn {
    width: 100%;
    background-color: rgb(163, 31, 55);
    border-color: rgb(163, 31, 55);
    color: white;
    justify-content: center;
    padding: 2vh 0;
    margin-top: 3vh
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.btn:hover {
    color: white
}

input:focus::-webkit-input-placeholder {
    color: transparent
}

input:focus:-moz-placeholder {
    color: transparent
}

input:focus::-moz-placeholder {
    color: transparent
}

input:focus:-ms-input-placeholder {
    color: transparent
}

</style>