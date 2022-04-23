<span class="navi-text text-muted text-hover-primary">
          <?php echo Auth::guard('user')->user()->name; ?>
</span>

<form class="form" id="logout_form" action="/logout-user" method="post">
          @csrf
          <a href="javascript:{}" onclick="document.getElementById('logout_form').submit();"
                    class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">
                    log out
          </a>
</form>