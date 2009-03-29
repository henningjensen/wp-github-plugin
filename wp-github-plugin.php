<html>
<head>
  <title>wp-github-plugin</title>
</head>
<body>

  <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
  <script type="text/javascript">
  var login = 'henningjensen';
  var showForks = false;
  var showPrivate = true;
  var numberOfProjects = 10;

  $.getJSON('http://github.com/api/v1/json/' + login + '?callback=?',
    function(data) {
      $.each(data.user.repositories, 
        function(i){
          if (!showForks && this.fork) return true;
          if (!showPrivate && this.private) return true;
          if (i == numberOfProjects) return false;
          $('#repositories').append('<li><a href="' + this.url + '">' + this.name + '</a></li>');
        }
      );
    }
  );
  </script>

  <h3>Repositories</h3>
  <ul id="repositories">
  </ul>

</body>
</html>
