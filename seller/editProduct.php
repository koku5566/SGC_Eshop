<?php
    require __DIR__ . '/header.php'
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product Details</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Update</a>
    </div>


                   <!-- List All Product -->
                    <div class="row">
                        <!--Product List -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Basic Information</h5>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="drag-list">
                                                <div class="drag-item" draggable="true">
                                                    <div class="image-container">
                                                        <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/iphone-black.jpg">
                                                        <div class="image-tools">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>

                                                        </div>
                                                    </div>
                                                    <p>Picture 1</p>
                                                </div>
                                                <div class="drag-item" draggable="true">B</div>
                                                <div class="drag-item" draggable="true">C</div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >Category</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter ..." aria-label="Category">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-primary">Search</button>
                                        <button type="button" class="btn btn-outline-dark">Reset</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

</div>
<!-- /.container-fluid -->

<style>

    @import "nib";

    [draggable] {
    user-select: none;
    }
    .drag-list {
    margin: 10px auto;
    border: 1px solid #ccc;
    flex-basis: 770px;
    }
    .drag-item {
    transition: 0.25s;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 80px;
    flex: 0 0 80px;
    width: 80px;
    max-width: 80px;
    min-height: 80px;
    max-height: 80px;
    margin: 0 16px 40px 0;
    }
    .drag-start {
    opacity: 0.8;
    }
    .drag-enter {
    opacity: 0.5;
    transform: scale(0.9);
    }

    .image-container{
        width: 80px;
        height: 80px;
        background-color: white;
    }

    .image-img-thumbnail:hover ~ .image-tools{
        background:grey;
        opacity:0.5;
    }

    .image-tools{
        width: 80px;
        height: 80px;
        background:white;
        opacity:0.1;
        z-index:100;
        position:absolute;
        margin-top: -80px;
    }
</style>

<script>
    function DragNSort (config) {
        this.$activeItem = null;
        this.$container = config.container;
        this.$items = this.$container.querySelectorAll('.' + config.itemClass);
        this.dragStartClass = config.dragStartClass;
        this.dragEnterClass = config.dragEnterClass;
    }

    DragNSort.prototype.removeClasses = function () {
        [].forEach.call(this.$items, function ($item) {
            $item.classList.remove(this.dragStartClass, this.dragEnterClass);
    }.bind(this));
    };

    DragNSort.prototype.on = function (elements, eventType, handler) {
        [].forEach.call(elements, function (element) {
        element.addEventListener(eventType, handler.bind(element, this), false);
    }.bind(this));
    };

    DragNSort.prototype.onDragStart = function (_this, event) {
    _this.$activeItem = this;

    this.classList.add(_this.dragStartClass);
    event.dataTransfer.effectAllowed = 'move';
    event.dataTransfer.setData('text/html', this.innerHTML);
    };

    DragNSort.prototype.onDragEnd = function (_this) {
        this.classList.remove(_this.dragStartClass);
    };

    DragNSort.prototype.onDragEnter = function (_this) {
        this.classList.add(_this.dragEnterClass);
    };

    DragNSort.prototype.onDragLeave = function (_this) {
        this.classList.remove(_this.dragEnterClass);
    };

    DragNSort.prototype.onDragOver = function (_this, event) {
    if (event.preventDefault) {
    event.preventDefault();
    }

    event.dataTransfer.dropEffect = 'move';

    return false;
    };

    DragNSort.prototype.onDrop = function (_this, event) {
        if (event.stopPropagation) {
        event.stopPropagation();
    }

    if (_this.$activeItem !== this) {
        _this.$activeItem.innerHTML = this.innerHTML;
        this.innerHTML = event.dataTransfer.getData('text/html');
    }

    _this.removeClasses();

    return false;
    };

    DragNSort.prototype.bind = function () {
        this.on(this.$items, 'dragstart', this.onDragStart);
        this.on(this.$items, 'dragend', this.onDragEnd);
        this.on(this.$items, 'dragover', this.onDragOver);
        this.on(this.$items, 'dragenter', this.onDragEnter);
        this.on(this.$items, 'dragleave', this.onDragLeave);
        this.on(this.$items, 'drop', this.onDrop);
    };

    DragNSort.prototype.init = function () {
        this.bind();
    };

    // Instantiate
    var draggable = new DragNSort({
        container: document.querySelector('.drag-list'),
    itemClass: 'drag-item',
    dragStartClass: 'drag-start',
    dragEnterClass: 'drag-enter'
    });
    draggable.init();
</script>

<?php
    require __DIR__ . '/footer.php'
?>