<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
      <h1>My Contact Book</h2>
      <div class="username">
        <div class="avatar">T</div>
        Tobias
      </div>
    </header>
    <div class="content">
      <aside class="aside-left">
          <nav class=main-nav">
          <ul class="main-nav-ul">
            <li class="main-nav-li"><a href="index.php?page=start" class="main-nav-a"><img src="img/home.svg">Start</a></li>
            <li class="main-nav-li"><a href="index.php?page=contacts" class="main-nav-a"><img src="img/contacts.svg">Kontakte</a></li>
            <li class="main-nav-li"><a href="index.php?page=add" class="main-nav-a"><img src="img/add_contact.svg">Kontakt hinzufügen</a></li>
            <li class="main-nav-li"><a href="index.php?page=details" class="main-nav-a"><img src="img/policy.svg">Meine Kontaktdaten</a></li>
          </ul>
        </nav>
      </aside>
      <main class="main">
        <?php
          $contacts = [];

          if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
          } 
          
          else {
            $page ="";
          }

          /* Startseite */
          if($page == 'start') {
            $headline = 'Herzlich Willkommen';

            echo '<h2>'. $headline  . '</h2>
                <p>Das wird ein Kontaktbuch.</p>';
          }

          /* Kontakte Übersicht */
          if(file_exists('contacts.txt')) {
            $text = file_get_contents('contacts.txt', true);
            $contacts = json_decode($text, true);
          }

          if(isset($_POST['name']) && isset($_POST['phone'])){
            echo 'Neuer Kontakt mit dem Namen '. $_POST["name"] . ' wurde hinzugefügt';
            $newContact = [
              'name' => $_POST['name'],
              'phone' => $_POST['phone']
            ];
            array_push($contacts, $newContact);
            file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
          }

          if($page == 'contacts') {
            $headline = 'Deine Kontakte';

            echo '<h2>'. $headline  . '</h2>
                <p>Hier hast du einen Überblick über deine Kontakte.</p>';

                foreach ($contacts as $row) {
                  $name = $row['name'];
                  $phone = $row['phone'];

                  echo "
                  <div class='card'>
                    <img class='profile' src='img/profile.png'>
                    <div class='details'>
                      <p class='d-name'>$name</p>
                      <p class='d-phone'>$phone</p>
                    </div>
                    <div  class='call'>
                      <a href='tel:$phone'><img src='img/call.png'></a>
                    </div>
                  </div>
                  ";
                }
          }

          /* Kontakte hinzufügen */
          if($page == 'add') {
            $headline = 'Kontakte hinzufügen';

            echo '<h2>'. $headline  . '</h2>
                <p>Hier kann man neue Kontakte eintragen.</p>
                
                <form action="?page=contacts" method="POST">
                  <input class="name" placeholder="Name eingeben" name="name">

                  <input class="phone" placeholder="Telefonnummer eingeben" name="phone">

                  <button class="submit" type="submit">Absenden</button>
                </form>
                ';
          }

          /* Meine Kontaktdaten */
          if($page == 'details') {
            $headline = 'Meine Kontaktdaten';

            echo '<h2>'. $headline  . '</h2>
                <p>Hier sind meine Kontaktdaten hinterlegt.</p>';
          }
        ?>
      </main>

      <aside class="aside-right">
        <nav class="social-nav">
          <ul class="social-nav-ul">
              <li class="social-nav-li"><a href="#" class="social-nav-a"><img src="img/facebook.png">Facebook</a></li>
              <li class="social-nav-li"><a href="#" class="social-nav-a"><img src="img/twitter.png">Twitter</a></li>
          </ul>
        </nav>
      </aside>
    </div>
    
    <footer>
      <p>&copy; 2023 Tobias Strohmeier</p>
    </footer>
</body>
</html>