<nav class="navbar bg-primary text-light">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="{{ route('commands.create')}}" style="color: white;" onMouseOver="this.style.color='black'">Add Command</a></li>
          <li><a href="{{ route('commands.show')}}" style="color: white;" onMouseOver="this.style.color='black'">Show Commands</a></li>
        </ul>
      </div>
    </div>
  </nav>