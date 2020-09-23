<div class="account-login">
     
         <div class="col2-set">
             <div class="wrapper">
                 <form action="../login.php?url=checkout/index.php" method="post" id="login-form">
                 <div class="registered-users-wrapper">
                     <div class="col-2 registered-users">
                         <div class="content">
                             <h2>Registered Customers</h2>
                             <p>If you have an account with us, please log in.</p>
                              <ul class="form-list">
                                 <li>
                                     <label for="email" class="required"><em>*</em>Email Address</label>

                                     <div class="input-box">
                                         <input type="email" name="username" value="" id="email" class="input-text required-entry validate-email form-control" title="Email Address">
                                     </div>
                                 </li>
                                 <li>
                                     <label for="pass" class="required"><em>*</em>Password</label>
                                     <div class="input-box">
                                         <input type="password" name="password" class="input-text required-entry validate-password form-control" id="pass" title="Password">
                                     </div>
                                     <input type="hidden" name="url" value="checkout/index.php" />
                                 </li>
                             </ul>
                             <p class="required">* Required Fields</p>

                             <div class="buttons-set">                               
                                 <button type="submit" class="button" title="Login" name="send" id="button-login"><span><span>Login</span></span></button>
                             </div>
                         </div>
                     </div>
                 </div>
                 </form>
                 <!--<form action="../registration.php" method="post" id="login-form">-->
                 <div class="new-users-wrapper">
                     <div class="col-1 new-users">
                         <div class="content">
                             <h2>New Customers</h2>
                             <div>Checkout Options :<br/>
                             <label for="register">
                        	<input type="radio" checked="checked" id="register" value="register" name="account">
                                <b>Register Account</b></label>
                             </div>
                             <p>By creating an account with our store, you will be able to move through the checkout
                                 process faster, store multiple shipping addresses, view and track your orders in your
                                 account and more.</p>
                             <input type="hidden" name="url" value="checkout/index.php" />
                             <a href="../registration.php?checkout/index.php">
                                <button class="button" type="button" title="Continue" ><span><span>Continue</span></span></button>
                            </a>
                             <!--<div class="buttons-set">
                                 <button type="submit" title="Continue" class="button" id="register"><span><span>Continue</span></span></button>
                             </div>-->
                        </div>
                     </div>
                 </div>
                     <!--</form>-->
             </div>
         </div>

 </div>