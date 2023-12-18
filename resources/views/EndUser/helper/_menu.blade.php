<!-- Restaurant Menu Section -->
<div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>Menu</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">

            @foreach($menus as $menu)
                <div class="col-xs-12 col-sm-6">
                    <div class="menu-section">
                        <h2 class="menu-section-title">{{$menu->category->name}}</h2>
                        <hr>
                        <div class="menu-item">
                            <div class="menu-item-name"> {{$menu->title}} </div>
                            <div class="menu-item-price"> ${{$menu->price}} </div>
                            <div class="menu-item-description"> {{$menu->body}} </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
