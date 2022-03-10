<?php
    require __DIR__ . '/header.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assecories</li>
                    </ol>
                </nav>

                    <!-- Product Row -->
                    <div class="row">
                        <!-- Picture -->
                        <div class="col-xl-8 col-md-6 mb-6">
                            <div id="custCarousel" class="carousel slide" data-interval="false">
                                <!-- slides -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active"> <img src="https://i.imgur.com/weXVL8M.jpg" alt="Hills"> </div>
                                    <div class="carousel-item"> <img src="https://i.imgur.com/Rpxx6wU.jpg" alt="Hills"> </div>
                                    <div class="carousel-item"> <img src="https://i.imgur.com/83fandJ.jpg" alt="Hills"> </div>
                                    <div class="carousel-item"> <img src="https://i.imgur.com/JiQ9Ppv.jpg" alt="Hills"> </div>
                                </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                                <ol class="carousel-indicators list-inline">
                                    <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="https://i.imgur.com/weXVL8M.jpg" class="img-fluid"> </a> </li>
                                    <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="https://i.imgur.com/Rpxx6wU.jpg" class="img-fluid"> </a> </li>
                                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="https://i.imgur.com/83fandJ.jpg" class="img-fluid"> </a> </li>
                                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="https://i.imgur.com/JiQ9Ppv.jpg" class="img-fluid"> </a> </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Product Content -->
                        <div class="col-xl-4 col-md-6 mb-6">
                            <br>
                            <!-- Name -->
                            <div class="row">
                                <div class="col">
                                    <h1 style="color:#a31f37;">IPhone 10 Pro Max</h1>
                                    <hr>
                                </div>
                            </div>
                            <!-- Rating/Rating Number/Sold -->
                            <div class="row">
                                <div class="col">
                                    <b>4.9 Rating</b>
                                </div>
                                <div class="col">
                                    <b>200 Rated</b>
                                </div>
                                <div class="col">
                                    <b>300 Sold</b>
                                </div>
                            </div>
                            <br>
                            <!-- Price -->
                            <div class="row">
                                <div class="col">
                                    <span style="color:#a31f37;font-size:18pt">RM 3500 - RM 4800</span>
                                </div>
                            </div>
                            <!-- Variation -->
                            <div class="row">
                                <div class="variation">
                                    <!-- Variation Loop here -->
                                    <div class="row">
                                        <ol class="list-inline">
                                            <li class="list-inline-item variation-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="https://i.imgur.com/weXVL8M.jpg" class="img-fluid"> </a> </li>
                                            <li class="list-inline-item variation-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="https://i.imgur.com/Rpxx6wU.jpg" class="img-fluid"> </a> </li>
                                            <li class="list-inline-item variation-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="https://i.imgur.com/83fandJ.jpg" class="img-fluid"> </a> </li>
                                            <li class="list-inline-item variation-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="https://i.imgur.com/JiQ9Ppv.jpg" class="img-fluid"> </a> </li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Quantity -->
                            <div class="row">
                                <div class="example">
                                    <div class="mc-quantity-selector">
                                        <button
                                        class="
                                            mc-button
                                            is-disabled
                                            mc-button--square mc-button--bordered
                                            mc-quantity-selector__button-left
                                        "
                                        aria-controls="qty-selector2"
                                        aria-label="Decrement"
                                        aria-hidden="true"
                                        tabindex="-1"
                                        >
                                        <svg class="mc-button__icon">
                                            <use xlink:href="#iconLeftM" />
                                        </svg>
                                        </button>

                                        <input
                                        id="qty-selector2"
                                        class="mc-text-input mc-quantity-selector__input"
                                        name="quantity-selector-input"
                                        aria-label="QuantitySelector"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-valuenow="0"
                                        type="number"
                                        placeholder="1"
                                        role="spinbutton"
                                        />

                                        <button
                                        class="
                                            mc-button mc-button--square mc-button--bordered
                                            mc-quantity-selector__button-right
                                        "
                                        aria-controls="qty-selector2"
                                        aria-label="Increment"
                                        aria-hidden="true"
                                        tabindex="-1"
                                        >
                                        <svg class="mc-button__icon">
                                            <use xlink:href="#iconRightM" />
                                        </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="10 Stock Avaiable">
                                    
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-primary">
                                        <span class="text">Add To Cart</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Profile -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <img class="img-thumbnail" src="data:image/jpeg;base64,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">
                                        </div>
                                        <div class="col-9 sidebar-brand-text" style="font-size:2rem;">Offical Apple Store</div>
                                    </div>


                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="row">
                                        <div class="col list-parent"> 
                                            <i class="fa fa-star"></i>
                                            <span>4.5</span>
                                        </div>
                                        <div class="col list-parent"> 
                                            <i class="fa fa-gift"></i>
                                            <span>120</span>
                                        </div>
                                        <div class="col list-parent"> 
                                            <i class="fa fa-calendar"></i>
                                            <span>2021</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2" style="text-align:center;">
                                    <a href="#" class="btn btn-primary" style="margin-top: 20%;">
                                        <span class="text">View Shop</span>
                                    </a>
                                </div>
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
    .list-parent i,a{
        padding:0.8rem 1.5rem;
    }

    .carousel-inner img {
        width: 100%;
        height: 100%
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
    }

    #custCarousel .carousel-indicators li.active img {
        opacity: 1
    }

    #custCarousel .carousel-indicators li:hover img {
        opacity: 0.75
    }


    @charset "UTF-8";
/* create columns */
/* create columns */
/* create custom named columns with custom content */
@font-face {
  font-family: "LeroyMerlin";
  src: url("/fonts/LeroyMerlinSans-Web-Light.woff2") format("woff2"), url("/fonts/LeroyMerlinSans-Web-Light.woff") format("woff");
  font-weight: 300;
  font-style: normal;
  font-display: swap;
}
@font-face {
  font-family: "LeroyMerlin";
  src: url("/fonts/LeroyMerlinSans-Web-Regular.woff2") format("woff2"), url("/fonts/LeroyMerlinSans-Web-Regular.woff") format("woff");
  font-weight: 400;
  font-style: normal;
  font-display: swap;
}
@font-face {
  font-family: "LeroyMerlin";
  src: url("/fonts/LeroyMerlinSans-Web-SemiBold.woff2") format("woff2"), url("/fonts/LeroyMerlinSans-Web-SemiBold.woff") format("woff");
  font-weight: 600;
  font-style: normal;
  font-display: swap;
}
@font-face {
  font-family: "LeroyMerlin";
  src: url("/fonts/LeroyMerlinSans-Web-LightItalic.woff2") format("woff2"), url("/fonts/LeroyMerlinSans-Web-LightItalic.woff") format("woff");
  font-weight: 300;
  font-style: italic;
  font-display: swap;
}
@font-face {
  font-family: "LeroyMerlin";
  src: url("/fonts/LeroyMerlinSans-Web-Italic.woff2") format("woff2"), url("/fonts/LeroyMerlinSans-Web-Italic.woff") format("woff");
  font-weight: 400;
  font-style: italic;
  font-display: swap;
}
@font-face {
  font-family: "LeroyMerlin";
  src: url("/fonts/LeroyMerlinSans-Web-SemiBoldItalic.woff2") format("woff2"), url("/fonts/LeroyMerlinSans-Web-SemiBoldItalic.woff") format("woff");
  font-weight: 600;
  font-style: italic;
  font-display: swap;
}
.mc-text-input {
  font-family: "LeroyMerlin", sans-serif;
  font-weight: 400;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  outline: none;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  padding: 0;
  margin: 0;
  -webkit-box-shadow: none;
          box-shadow: none;
  border: none;
  /* for mozilla */
  /* stylelint-disable-next-line */
  font-size: 1rem;
  line-height: 1.375;
  min-height: 3rem;
  padding: 0.75rem 0.6875rem;
  -webkit-transition: -webkit-box-shadow 200ms ease;
  transition: -webkit-box-shadow 200ms ease;
  -o-transition: box-shadow 200ms ease;
  transition: box-shadow 200ms ease;
  transition: box-shadow 200ms ease, -webkit-box-shadow 200ms ease;
  display: block;
  width: 100%;
  position: relative;
  border: 1px solid #6f676c;
  color: #222020;
  background-color: #ffffff;
  border-radius: 4px;
}
.mc-text-input[type=number]::-webkit-inner-spin-button, .mc-text-input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
          appearance: none;
  margin: 0;
}
.mc-text-input[type=number] {
  -moz-appearance: textfield;
}
.mc-text-input[type=search]::-webkit-search-decoration:hover, .mc-text-input[type=search]::-webkit-search-cancel-button:hover {
  cursor: pointer;
}
.mc-text-input::-webkit-input-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input::-moz-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input:-ms-input-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input::-ms-input-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input::placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input::-webkit-input-placeholder {
  margin: 0;
  color: #887f87;
  opacity: 1;
}
.mc-text-input::-moz-placeholder {
  margin: 0;
  color: #887f87;
  opacity: 1;
}
.mc-text-input:-ms-input-placeholder {
  margin: 0;
  color: #887f87;
  opacity: 1;
}
.mc-text-input::-ms-input-placeholder {
  margin: 0;
  color: #887f87;
  opacity: 1;
}
.mc-text-input::placeholder {
  margin: 0;
  color: #887f87;
  opacity: 1;
}
.mc-text-input.is-valid, .mc-text-input.is-invalid {
  background-repeat: no-repeat;
  background-size: 1rem 1rem;
  background-position: right 0.5rem center;
  padding-right: 2.5rem;
}
.mc-text-input.is-valid {
  border-color: #78be20;
  background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMXJlbSIgd2lkdGg9IjFyZW0iIGZpbGw9IiM3OGJlMjAiIHZpZXdCb3g9IjAgMCAxNiAxNiI+PHBhdGggZD0iTTcuNjMgMTEuMjFhMSAxIDAgMCAxLTEuMzggMGwtMi45Mi0yLjZhMSAxIDAgMSAxIDEuMzQtMS40OGwyLjIyIDIgNC40MS00LjM0YTEgMSAwIDEgMSAxLjQgMS40MnoiLz48L3N2Zz4=');
}
.mc-text-input.is-valid:hover, .mc-text-input.is-valid.is-hover {
  border-color: #0a601b;
}
.mc-text-input.is-invalid {
  border-color: #b42a27;
  background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMXJlbSIgd2lkdGg9IjFyZW0iIGZpbGw9IiNiNDJhMjciIHZpZXdCb3g9IjAgMCAxNiAxNiI+PHBhdGggZD0iTTkuNDEgOGwzLjMtMy4yOWExIDEgMCAxMC0xLjQyLTEuNDJMOCA2LjU5bC0zLjI5LTMuM2ExIDEgMCAwMC0xLjQyIDEuNDJMNi41OSA4bC0zLjMgMy4yOWExIDEgMCAwMDAgMS40MiAxIDEgMCAwMDEuNDIgMEw4IDkuNDFsMy4yOSAzLjNhMSAxIDAgMDAxLjQyIDAgMSAxIDAgMDAwLTEuNDJ6Ii8+PC9zdmc+');
}
.mc-text-input.is-invalid:hover, .mc-text-input.is-invalid.is-hover {
  border-color: #641b21;
}
.mc-text-input.is-hover,
.mc-text-input:hover {
  border-color: #222020;
}

.mc-text-input.is-focus,
.mc-text-input:focus {
  -webkit-box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
          box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
}

.mc-text-input:disabled {
  border-color: #eeeef0;
  background: #eeeef0;
  cursor: not-allowed;
}
.mc-text-input--s {
  font-size: 0.875rem;
  line-height: 1.2857142857;
  min-height: 2rem;
  padding: 0.375rem 0.4375rem;
}
.mc-text-input--s::-webkit-input-placeholder {
  font-size: 0.875rem;
  line-height: 1.2857142857;
}
.mc-text-input--s::-moz-placeholder {
  font-size: 0.875rem;
  line-height: 1.2857142857;
}
.mc-text-input--s:-ms-input-placeholder {
  font-size: 0.875rem;
  line-height: 1.2857142857;
}
.mc-text-input--s::-ms-input-placeholder {
  font-size: 0.875rem;
  line-height: 1.2857142857;
}
.mc-text-input--s::placeholder {
  font-size: 0.875rem;
  line-height: 1.2857142857;
}
.mc-text-input--m {
  font-size: 1rem;
  line-height: 1.375;
  min-height: 3rem;
  padding: 0.75rem 0.6875rem;
}
.mc-text-input--m::-webkit-input-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input--m::-moz-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input--m:-ms-input-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input--m::-ms-input-placeholder {
  font-size: 1rem;
  line-height: 1.375;
}
.mc-text-input--m::placeholder {
  font-size: 1rem;
  line-height: 1.375;
}

@media screen and (min-width: 680px) {
  .mc-text-input--s\@from-m {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    min-height: 2rem;
    padding: 0.375rem 0.4375rem;
  }
  .mc-text-input--s\@from-m::-webkit-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-m::-moz-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-m:-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-m::-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-m::placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--m\@from-m {
    font-size: 1rem;
    line-height: 1.375;
    min-height: 3rem;
    padding: 0.75rem 0.6875rem;
  }
  .mc-text-input--m\@from-m::-webkit-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-m::-moz-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-m:-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-m::-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-m::placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
}

@media screen and (min-width: 1024px) {
  .mc-text-input--s\@from-l {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    min-height: 2rem;
    padding: 0.375rem 0.4375rem;
  }
  .mc-text-input--s\@from-l::-webkit-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-l::-moz-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-l:-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-l::-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-l::placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--m\@from-l {
    font-size: 1rem;
    line-height: 1.375;
    min-height: 3rem;
    padding: 0.75rem 0.6875rem;
  }
  .mc-text-input--m\@from-l::-webkit-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-l::-moz-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-l:-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-l::-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-l::placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
}

@media screen and (min-width: 1280px) {
  .mc-text-input--s\@from-xl {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    min-height: 2rem;
    padding: 0.375rem 0.4375rem;
  }
  .mc-text-input--s\@from-xl::-webkit-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xl::-moz-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xl:-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xl::-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xl::placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--m\@from-xl {
    font-size: 1rem;
    line-height: 1.375;
    min-height: 3rem;
    padding: 0.75rem 0.6875rem;
  }
  .mc-text-input--m\@from-xl::-webkit-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xl::-moz-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xl:-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xl::-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xl::placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
}

@media screen and (min-width: 1920px) {
  .mc-text-input--s\@from-xxl {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    min-height: 2rem;
    padding: 0.375rem 0.4375rem;
  }
  .mc-text-input--s\@from-xxl::-webkit-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xxl::-moz-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xxl:-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xxl::-ms-input-placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--s\@from-xxl::placeholder {
    font-size: 0.875rem;
    line-height: 1.2857142857;
  }
  .mc-text-input--m\@from-xxl {
    font-size: 1rem;
    line-height: 1.375;
    min-height: 3rem;
    padding: 0.75rem 0.6875rem;
  }
  .mc-text-input--m\@from-xxl::-webkit-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xxl::-moz-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xxl:-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xxl::-ms-input-placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
  .mc-text-input--m\@from-xxl::placeholder {
    font-size: 1rem;
    line-height: 1.375;
  }
}
.mc-field__label, .mc-field__legend {
  color: #3c3738;
}
.mc-field__label {
  font-size: 0.875rem;
  line-height: 1.1428571429;
}
.mc-field__legend {
  font-size: 0.875rem;
  line-height: 1.2857142857;
  padding-left: 0;
  padding-right: 0;
}
.mc-field__requirement, .mc-field__help {
  font-size: 0.75rem;
  line-height: 1.1666666667;
  color: #6f676c;
}
.mc-field__requirement::before {
  content: " - ";
}
.mc-field__help {
  display: block;
  margin-top: 0.25rem;
}
.mc-field .mc-field__input,
.mc-field .mc-field__element {
  margin-top: 0.5rem;
}
.mc-field__container {
  margin-top: 1rem;
}
@media screen and (min-width: 769px) {
  .mc-field__container--inline {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }
}
@media screen and (min-width: 769px) {
  .mc-field__container--inline .mc-field__item:not(:last-child) {
    margin-bottom: 0;
    margin-right: 1rem;
  }
}
@media screen and (min-width: 1024px) {
  .mc-field__container--inline .mc-field__item:not(:last-child) {
    margin-right: 2rem;
  }
}
.mc-field__item:not(:last-child) {
  margin-bottom: 1rem;
}
.mc-field__error-message {
  font-size: 0.875rem;
  line-height: 1.2857142857;
  color: #b42a27;
  display: inline-block;
  margin-top: 0.25rem;
}
.mc-field--group {
  border: none;
  margin-left: 0;
  margin-right: 0;
  padding: 0;
}
.mc-field--group .mc-field__error-message {
  margin-top: 0.5rem;
}
.mc-button {
  margin: 0;
  -webkit-box-shadow: none;
          box-shadow: none;
  text-decoration: none;
  outline: none;
  border: none;
  padding: 0;
  cursor: pointer;
  color: #ffffff;
  background-color: #78be20;
  font-family: "LeroyMerlin", sans-serif;
  font-weight: 600;
  font-size: 1rem;
  line-height: 1.375;
  padding: 0.6875rem 1.5rem;
  min-height: 3rem;
  min-width: 3rem;
  cursor: pointer;
  border-radius: 4px;
  text-align: center;
  border: 2px solid transparent;
  -webkit-transition: all ease 200ms;
  -o-transition: all ease 200ms;
  transition: all ease 200ms;
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  vertical-align: middle;
  -webkit-box-align: stretch;
      -ms-flex-align: stretch;
          align-items: stretch;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  fill: currentColor;
}
.mc-button.is-hover,
.mc-button:hover {
  background-color: #41a017;
  color: #ffffff;
}

.mc-button.is-active,
.mc-button:active {
  background-color: #158110;
}

.mc-button.is-disabled,
.mc-button:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button .mc-button__icon {
  width: 1.5rem;
  height: 1.5rem;
}
.mc-button .mc-button__icon:first-child, .mc-button .mc-button__icon:last-child {
  margin-bottom: -1px;
  margin-top: -1px;
}
.mc-button .mc-button__icon:only-child {
  margin-bottom: 0;
  margin-top: 0;
  width: 2rem;
  height: 2rem;
}
.mc-button.is-focus,
.mc-button:focus {
  -webkit-box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
          box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
}

.mc-button--s {
  font-size: 0.875rem;
  line-height: 1.2857142857;
  padding: 0.3125rem 1rem;
  min-height: 2rem;
  min-width: 2rem;
}
.mc-button--s .mc-button__icon {
  width: 1.5rem;
  height: 1.5rem;
}
.mc-button--s .mc-button__icon:first-child, .mc-button--s .mc-button__icon:last-child {
  margin-bottom: -0.1875rem;
  margin-top: -0.1875rem;
}
.mc-button--s .mc-button__icon:only-child {
  margin-bottom: 0;
  margin-top: 0;
  width: 1.5rem;
  height: 1.5rem;
}
.mc-button--m {
  font-size: 1rem;
  line-height: 1.375;
  padding: 0.6875rem 1.5rem;
  min-height: 3rem;
  min-width: 3rem;
}
.mc-button--m .mc-button__icon {
  width: 1.5rem;
  height: 1.5rem;
}
.mc-button--m .mc-button__icon:first-child, .mc-button--m .mc-button__icon:last-child {
  margin-bottom: -1px;
  margin-top: -1px;
}
.mc-button--m .mc-button__icon:only-child {
  margin-bottom: 0;
  margin-top: 0;
  width: 2rem;
  height: 2rem;
}
.mc-button--l {
  font-size: 1.125rem;
  line-height: 1.3333333333;
  padding: 0.875rem 1.5rem;
  min-height: 3.5rem;
  min-width: 3.5rem;
}
.mc-button--l .mc-button__icon {
  width: 2rem;
  height: 2rem;
}
.mc-button--l .mc-button__icon:first-child, .mc-button--l .mc-button__icon:last-child {
  margin-bottom: -0.25rem;
  margin-top: -0.25rem;
}
.mc-button--l .mc-button__icon:only-child {
  margin-bottom: 0;
  margin-top: 0;
  width: 2rem;
  height: 2rem;
}
.mc-button--fit {
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
  width: auto;
}
.mc-button--full {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  width: 100%;
}
@supports ((width: -webkit-fill-available) or (width: -moz-available) or (width: stretch)) {
  .mc-button--full {
    width: -webkit-fill-available;
    width: -moz-available;
    width: stretch;
  }
}
.mc-button--square {
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  height: 0;
  padding: 0;
}
.mc-button__icon {
  -ms-flex-negative: 0;
      flex-shrink: 0;
}
.mc-button__icon:last-child {
  margin-left: 0.5rem;
  margin-right: -0.25rem;
}
.mc-button__icon:first-child {
  margin-right: 0.5rem;
  margin-left: -0.25rem;
}
.mc-button__icon:only-child {
  margin: 0;
}
.mc-button__label {
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  pointer-events: none;
}
.mc-button--solid-primary-02 {
  background-color: #007574;
}
.mc-button--solid-primary-02.is-hover,
.mc-button--solid-primary-02:hover {
  background-color: #063a44;
}

.mc-button--solid-primary-02.is-active,
.mc-button--solid-primary-02:active {
  background-color: #062b35;
}

.mc-button--solid-primary-02.is-disabled,
.mc-button--solid-primary-02:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button--solid-neutral {
  background-color: #3c3738;
}
.mc-button--solid-neutral.is-hover,
.mc-button--solid-neutral:hover {
  background-color: #222020;
}

.mc-button--solid-neutral.is-active,
.mc-button--solid-neutral:active {
  background-color: #3c3738;
}

.mc-button--solid-neutral.is-disabled,
.mc-button--solid-neutral:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button--solid-danger {
  background-color: #df382b;
}
.mc-button--solid-danger.is-hover,
.mc-button--solid-danger:hover {
  background-color: #b42a27;
}

.mc-button--solid-danger.is-active,
.mc-button--solid-danger:active {
  background-color: #8b2226;
}

.mc-button--solid-danger.is-disabled,
.mc-button--solid-danger:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button--bordered {
  color: #78be20;
  border-color: #78be20;
  background-color: #ffffff;
}
.mc-button--bordered.is-hover,
.mc-button--bordered:hover {
  background-color: #eaf3e2;
  color: #78be20;
}

.mc-button--bordered.is-active,
.mc-button--bordered:active {
  background-color: #cbe3b5;
}

.mc-button--bordered.is-disabled,
.mc-button--bordered:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button--bordered-primary-02 {
  color: #007574;
  border-color: #007574;
  background-color: #ffffff;
}
.mc-button--bordered-primary-02.is-hover,
.mc-button--bordered-primary-02:hover {
  background-color: #dbedea;
  color: #007574;
}

.mc-button--bordered-primary-02.is-active,
.mc-button--bordered-primary-02:active {
  background-color: #a5d1cb;
}

.mc-button--bordered-primary-02.is-disabled,
.mc-button--bordered-primary-02:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button--bordered-neutral {
  color: #3c3738;
  border-color: #3c3738;
  background-color: #ffffff;
}
.mc-button--bordered-neutral.is-hover,
.mc-button--bordered-neutral:hover {
  background-color: #eeeef0;
  color: #3c3738;
}

.mc-button--bordered-neutral.is-active,
.mc-button--bordered-neutral:active {
  background-color: #d3d2d6;
}

.mc-button--bordered-neutral.is-disabled,
.mc-button--bordered-neutral:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

.mc-button--bordered-danger {
  color: #df382b;
  border-color: #df382b;
  background-color: #ffffff;
}
.mc-button--bordered-danger.is-hover,
.mc-button--bordered-danger:hover {
  background-color: #feedee;
  color: #df382b;
}

.mc-button--bordered-danger.is-active,
.mc-button--bordered-danger:active {
  background-color: #fab9bc;
}

.mc-button--bordered-danger.is-disabled,
.mc-button--bordered-danger:disabled {
  border-color: transparent;
  background-color: #d3d2d6;
  color: #6f676c;
  cursor: not-allowed;
}

@media screen and (min-width: 680px) {
  .mc-button--s\@from-m {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    padding: 0.3125rem 1rem;
    min-height: 2rem;
    min-width: 2rem;
  }
  .mc-button--s\@from-m .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--s\@from-m .mc-button__icon:first-child, .mc-button--s\@from-m .mc-button__icon:last-child {
    margin-bottom: -0.1875rem;
    margin-top: -0.1875rem;
  }
  .mc-button--s\@from-m .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-m {
    font-size: 1rem;
    line-height: 1.375;
    padding: 0.6875rem 1.5rem;
    min-height: 3rem;
    min-width: 3rem;
  }
  .mc-button--m\@from-m .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-m .mc-button__icon:first-child, .mc-button--m\@from-m .mc-button__icon:last-child {
    margin-bottom: -1px;
    margin-top: -1px;
  }
  .mc-button--m\@from-m .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-m {
    font-size: 1.125rem;
    line-height: 1.3333333333;
    padding: 0.875rem 1.5rem;
    min-height: 3.5rem;
    min-width: 3.5rem;
  }
  .mc-button--l\@from-m .mc-button__icon {
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-m .mc-button__icon:first-child, .mc-button--l\@from-m .mc-button__icon:last-child {
    margin-bottom: -0.25rem;
    margin-top: -0.25rem;
  }
  .mc-button--l\@from-m .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--fit\@from-m {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    width: auto;
  }
  .mc-button--full\@from-m {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
  }
  @supports ((width: -webkit-fill-available) or (width: -moz-available) or (width: stretch)) {
    .mc-button--full\@from-m {
      width: -webkit-fill-available;
      width: -moz-available;
      width: stretch;
    }
  }
}

@media screen and (min-width: 1024px) {
  .mc-button--s\@from-l {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    padding: 0.3125rem 1rem;
    min-height: 2rem;
    min-width: 2rem;
  }
  .mc-button--s\@from-l .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--s\@from-l .mc-button__icon:first-child, .mc-button--s\@from-l .mc-button__icon:last-child {
    margin-bottom: -0.1875rem;
    margin-top: -0.1875rem;
  }
  .mc-button--s\@from-l .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-l {
    font-size: 1rem;
    line-height: 1.375;
    padding: 0.6875rem 1.5rem;
    min-height: 3rem;
    min-width: 3rem;
  }
  .mc-button--m\@from-l .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-l .mc-button__icon:first-child, .mc-button--m\@from-l .mc-button__icon:last-child {
    margin-bottom: -1px;
    margin-top: -1px;
  }
  .mc-button--m\@from-l .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-l {
    font-size: 1.125rem;
    line-height: 1.3333333333;
    padding: 0.875rem 1.5rem;
    min-height: 3.5rem;
    min-width: 3.5rem;
  }
  .mc-button--l\@from-l .mc-button__icon {
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-l .mc-button__icon:first-child, .mc-button--l\@from-l .mc-button__icon:last-child {
    margin-bottom: -0.25rem;
    margin-top: -0.25rem;
  }
  .mc-button--l\@from-l .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--fit\@from-l {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    width: auto;
  }
  .mc-button--full\@from-l {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
  }
  @supports ((width: -webkit-fill-available) or (width: -moz-available) or (width: stretch)) {
    .mc-button--full\@from-l {
      width: -webkit-fill-available;
      width: -moz-available;
      width: stretch;
    }
  }
}

@media screen and (min-width: 1280px) {
  .mc-button--s\@from-xl {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    padding: 0.3125rem 1rem;
    min-height: 2rem;
    min-width: 2rem;
  }
  .mc-button--s\@from-xl .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--s\@from-xl .mc-button__icon:first-child, .mc-button--s\@from-xl .mc-button__icon:last-child {
    margin-bottom: -0.1875rem;
    margin-top: -0.1875rem;
  }
  .mc-button--s\@from-xl .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-xl {
    font-size: 1rem;
    line-height: 1.375;
    padding: 0.6875rem 1.5rem;
    min-height: 3rem;
    min-width: 3rem;
  }
  .mc-button--m\@from-xl .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-xl .mc-button__icon:first-child, .mc-button--m\@from-xl .mc-button__icon:last-child {
    margin-bottom: -1px;
    margin-top: -1px;
  }
  .mc-button--m\@from-xl .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-xl {
    font-size: 1.125rem;
    line-height: 1.3333333333;
    padding: 0.875rem 1.5rem;
    min-height: 3.5rem;
    min-width: 3.5rem;
  }
  .mc-button--l\@from-xl .mc-button__icon {
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-xl .mc-button__icon:first-child, .mc-button--l\@from-xl .mc-button__icon:last-child {
    margin-bottom: -0.25rem;
    margin-top: -0.25rem;
  }
  .mc-button--l\@from-xl .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--fit\@from-xl {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    width: auto;
  }
  .mc-button--full\@from-xl {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
  }
  @supports ((width: -webkit-fill-available) or (width: -moz-available) or (width: stretch)) {
    .mc-button--full\@from-xl {
      width: -webkit-fill-available;
      width: -moz-available;
      width: stretch;
    }
  }
}

@media screen and (min-width: 1920px) {
  .mc-button--s\@from-xxl {
    font-size: 0.875rem;
    line-height: 1.2857142857;
    padding: 0.3125rem 1rem;
    min-height: 2rem;
    min-width: 2rem;
  }
  .mc-button--s\@from-xxl .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--s\@from-xxl .mc-button__icon:first-child, .mc-button--s\@from-xxl .mc-button__icon:last-child {
    margin-bottom: -0.1875rem;
    margin-top: -0.1875rem;
  }
  .mc-button--s\@from-xxl .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-xxl {
    font-size: 1rem;
    line-height: 1.375;
    padding: 0.6875rem 1.5rem;
    min-height: 3rem;
    min-width: 3rem;
  }
  .mc-button--m\@from-xxl .mc-button__icon {
    width: 1.5rem;
    height: 1.5rem;
  }
  .mc-button--m\@from-xxl .mc-button__icon:first-child, .mc-button--m\@from-xxl .mc-button__icon:last-child {
    margin-bottom: -1px;
    margin-top: -1px;
  }
  .mc-button--m\@from-xxl .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-xxl {
    font-size: 1.125rem;
    line-height: 1.3333333333;
    padding: 0.875rem 1.5rem;
    min-height: 3.5rem;
    min-width: 3.5rem;
  }
  .mc-button--l\@from-xxl .mc-button__icon {
    width: 2rem;
    height: 2rem;
  }
  .mc-button--l\@from-xxl .mc-button__icon:first-child, .mc-button--l\@from-xxl .mc-button__icon:last-child {
    margin-bottom: -0.25rem;
    margin-top: -0.25rem;
  }
  .mc-button--l\@from-xxl .mc-button__icon:only-child {
    margin-bottom: 0;
    margin-top: 0;
    width: 2rem;
    height: 2rem;
  }
  .mc-button--fit\@from-xxl {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    width: auto;
  }
  .mc-button--full\@from-xxl {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
  }
  @supports ((width: -webkit-fill-available) or (width: -moz-available) or (width: stretch)) {
    .mc-button--full\@from-xxl {
      width: -webkit-fill-available;
      width: -moz-available;
      width: stretch;
    }
  }
}
.mc-quantity-selector {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  position: relative;
}
.mc-quantity-selector__button-right, .mc-quantity-selector__button-left {
  position: relative;
}
.mc-quantity-selector__button-right::after, .mc-quantity-selector__button-left::after {
  border-radius: 2px;
  -webkit-box-shadow: 0 0 0 0 transparent;
          box-shadow: 0 0 0 0 transparent;
  content: "";
  display: block;
  pointer-events: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  -webkit-transition: -webkit-box-shadow 200ms ease;
  transition: -webkit-box-shadow 200ms ease;
  -o-transition: box-shadow 200ms ease;
  transition: box-shadow 200ms ease;
  transition: box-shadow 200ms ease, -webkit-box-shadow 200ms ease;
  top: -0.25rem;
  right: -0.25rem;
  bottom: -0.25rem;
  left: -0.25rem;
}
.mc-quantity-selector__button-right:focus, .mc-quantity-selector__button-left:focus {
  -webkit-box-shadow: none;
          box-shadow: none;
  z-index: 1;
}
.mc-quantity-selector__button-right:focus::after, .mc-quantity-selector__button-left:focus::after {
  -webkit-box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
          box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
  -webkit-box-shadow: 0 0 0 0.125rem #25a8d0;
          box-shadow: 0 0 0 0.125rem #25a8d0;
}
.mc-quantity-selector__button-right {
  border-radius: 0 0.25rem 0.25rem 0;
}
.mc-quantity-selector__button-right:focus::after {
  border-radius: 0.25rem 0.375rem 0.375rem 0.25rem;
}
.mc-quantity-selector__button-left {
  border-radius: 0.25rem 0 0 0.25rem;
}
.mc-quantity-selector__button-left:focus::after {
  border-radius: 0.375rem 0.25rem 0.25rem 0.375rem;
}
.mc-quantity-selector__input {
  border-radius: 0;
  border-left: none;
  border-right: none;
}
.mc-quantity-selector__input::-webkit-input-placeholder {
  text-align: center;
}
.mc-quantity-selector__input::-moz-placeholder {
  text-align: center;
}
.mc-quantity-selector__input:-ms-input-placeholder {
  text-align: center;
}
.mc-quantity-selector__input::-ms-input-placeholder {
  text-align: center;
}
.mc-quantity-selector__input, .mc-quantity-selector__input::placeholder {
  text-align: center;
}
.mc-quantity-selector__input:focus {
  -webkit-box-shadow: none;
          box-shadow: none;
  position: relative;
  z-index: 1;
}
.mc-quantity-selector__input:focus ~ .mc-quantity-selector__button-right {
  position: static;
}
.mc-quantity-selector__input:focus ~ .mc-quantity-selector__button-right::after {
  -webkit-box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
          box-shadow: 0 0 0 0.125rem #ffffff, 0 0 0 0.25rem #25a8d0;
  border-radius: 0.125rem;
  -webkit-box-shadow: 0 0 0 0.125rem #25a8d0;
          box-shadow: 0 0 0 0.125rem #25a8d0;
  top: -2px;
  right: 46px;
  bottom: -2px;
  left: 46px;
}

.example {
  font-family: "LeroyMerlin", sans-serif;
  font-weight: 400;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  margin: 2rem;
</style>