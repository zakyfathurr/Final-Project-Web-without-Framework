<header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="{{url('home')}}" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Admin</strong><strong> Page</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
              <a href="{{url('home_user')}}" class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></a>
            <!-- Sidebar Toggle Btn-->
            <!-- <button href="index.html" class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button> -->
          </div>


            <!-- Tasks end-->
            
            <!-- Megamenu end     -->
            <!-- Languages dropdown    -->
            
            <!-- Log out               -->
                                             <a class="btn btn-danger" href="{{route('logout')}}">LOG OUT</a>
                                          </li>
                </form>
          </div>
        </div>
      </nav>
    </header>