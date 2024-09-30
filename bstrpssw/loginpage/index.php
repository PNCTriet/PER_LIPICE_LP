<!DOCTYPE html>
<html>
  <head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="main">
      <input type="checkbox" id="chk" aria-hidden="true" />

      <div class="signup">
        <form>
          <label for="chk" aria-hidden="true">Sign up</label>
          <input type="text" name="txt" placeholder="User name" required="" />
          <input type="email" name="email" placeholder="Email" required="" />
          <input
            type="password"
            name="pswd"
            placeholder="Password"
            required=""
          />
          <button>Sign up</button>
        </form>
      </div>

      <div class="login">
        <form id="loginForm">
          <label for="chk" aria-hidden="true">Login</label>
          <input id="AccInput" type="text" name="acc" placeholder="Account" required="" />
          <input
            id="PassInput"
            type="password"
            name="pswd"
            placeholder="Password"
            required=""
          />
          <button type="submit">Login</button>
        </form>
      </div>
    </div>
    <script src="./main.js"></script>
  </body>
</html>
