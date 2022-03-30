<?php
    require __DIR__ . '/header.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Auditorium</a></li>
                        <li class="breadcrumb-item active" aria-current="page">RM Per Hour</li>
                    </ol>
                </nav>


                        <!-- Product Content -->
                        <div class="col-xl-4 col-md-6 mb-6">
                            <br>
                            <!-- Name -->
                            <div class="row">
                                <div class="col">
                                    <h1 style="color:#a31f37;">Auditorium</h1>
                                    <hr>
                                </div>
                            </div>
                            <!-- Information -->
                            <div class="row">
                                <div class="col">
                                    <b>Address</b>
                                </div>
                                <div class="col">
                                    <b></b>
                                </div>
                                <div class="col">
                                    <b></b>
                                </div>
                            </div>
                            <br>
                            <!-- Per Hour -->
                            <div class="row">
                                <div class="col">
                                    <span style="color:#a31f37;font-size:10pt">Per Hour</span>
                                </div>
                            </div>

                        
                            <!-- Button -->
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-primary">
                                        <span class="text">WhatsApp application</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .image-container{
        width:100%;
        height: 40vh;
        padding: 20px;
    }
    .image-container .image{
        max-height: 100%;
        max-width: 100%;
    }
    .list-parent{
        white-space: nowrap;
        font-size: x-large;
    }
    .list-inline-item{
        background-color:white;
    }

    .carousel-item{
        height:60vh;
        background-color:white;
    }

    .carousel-inner img {
        width: 100%;
        height: 100%;
        object-fit:contain;
    }

    #custCarousel .carousel-indicators {
        position: static;
        margin-top: 20px
    }

    #custCarousel .carousel-indicators>li {
        width: 100px
    }

    #custCarousel .carousel-indicators li img {
        display: block;
        opacity: 0.5
    }

    .variation-item{
        width:100px;
        padding:1rem;
        text-align:center;
        color:black;
    }

    #custCarousel .carousel-indicators li.active img {
        opacity: 1
    }

    #custCarousel .carousel-indicators li:hover img {
        opacity: 0.75
    }

    .numner-input{
        padding: 0 0 1rem 0;
    }

    .quantity-input{
        appearance: textfield;
        min-height: 3rem;
        text-align: center;
    }

    .quantity-selector-btn{
        min-width:3rem;
        min-height:3rem;
        color: #ffffff;
        border-color: #a31f37;
        background-color: #a31f37;
        transition: all ease 200ms;
    }

    .quantity-selector-btn:hover{
        opacity:0.8;
    }


</style>