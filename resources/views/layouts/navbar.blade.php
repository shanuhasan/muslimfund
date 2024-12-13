 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="javascript:void(0);" class="nav-link">Contact</a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <li class="nav-item">
             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <a href="{{ route('logout') }}" class="nav-link"
                     onclick="event.preventDefault();
                this.closest('form').submit();">
                     Logout
                 </a>
             </form>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
