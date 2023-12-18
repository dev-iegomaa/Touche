<!-- Portfolio Section -->
<div id="portfolio">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>Gallery</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="categories">
                <ul class="cat">
                    <li>
                        <ol class="type">
                            <li><a href="#" data-filter="*" class="active">All</a></li>
                            <li><a href="#" data-filter=".breakfast">Breakfast</a></li>
                            <li><a href="#" data-filter=".lunch">Lunch</a></li>
                            <li><a href="#" data-filter=".dinner">Dinner</a></li>
                        </ol>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="portfolio-items">
                @foreach($meals as $meal)
                <div class="col-sm-6 col-md-4 col-lg-4 {{$meal->type}}">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="{{$meal->image}}" title="Dish Name" data-lightbox-gallery="gallery1">
                                <div class="hover-text">
                                    <h4>{{$meal->name}}</h4>
                                </div>
                                <img src="{{$meal->image}}" class="img-responsive" alt="Project Title">
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
