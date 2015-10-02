<?php

namespace view;

class LayoutView {

  public function render($isLoggedIn = false, $html, DateTimeView $dtv, NagivationView $navigationView) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $navigationView->render($isLoggedIn) . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $html . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
