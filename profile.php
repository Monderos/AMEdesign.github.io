<?php
include_once "navbar.php";
if(!isset($_SESSION["userid"])){
    header("location: login.php");
    exit();
}
?>
<?php



?>



<section class="_profile">
<div class="d-flex justify-content-center profile">


<ul class="list-group">
  <li class="list-group-item d-flex">
      
    <!-- <div class="container"> -->
        <span class="font-rubik b"> Numele:</span>
    <span class="white font-rubik">
   
        <?php
        if($_SESSION["username"]!=NULL){
        echo $_SESSION["username"];
        }
        else {
            echo "-";
        }
        ?></span>
      <!-- </div> -->
  </li>
  
  <li class="list-group-item d-flex ">
  <span class="font-rubik b"> Username:</span> 
    <span class="white font-rubik ">
    <?php
        if($_SESSION["useruid"]!=NULL){
        echo $_SESSION["useruid"];
        }
        else {
            echo "-";
        }
        ?></span>
    </span>
  </li>
  
  <li class="list-group-item d-flex ">
  <span class="font-rubik b"> Email:</span>
    <span class="white font-rubik ">
    <?php
        if($_SESSION["useremail"]!=NULL){
        echo $_SESSION["useremail"];
        }
        else {
            echo "-";
        }
        ?></span>
    </span>
  </li>
  <li class="list-group-item d-flex ">
  <span class="font-rubik b"> Telefon:</span>
    <span class="white font-rubik ">

    <?php

if($_SESSION["userphone"]!=NULL){
    echo $_SESSION["userphone"];
    }
    else {
        echo "-";
    }
?>

    </span>
  </li>
  <li class="list-group-item d-flex ">
  <span class="font-rubik b"> Oraș/Sector:</span>
    <span class="white font-rubik ">
    <?php
        if($_SESSION["usercity"]!=NULL){
        echo $_SESSION["usercity"];
        }
        else {
            echo "-";
        }
        ?>
    </span>
  </li>
  <li class="list-group-item d-flex ">
  <span class="font-rubik b"> Adresă:</span> 
    <span class="white font-rubik ">
    <?php
        if($_SESSION["useraddress"]!=NULL){
        echo $_SESSION["useraddress"];
        }
        else {
            echo "-";
        }
        ?>
    </span>
  </li>
  <li class="list-group-item d-flex">
      
  <a href="profile_update.php">
    <button action="" class="fa fa-edit">   
        
    </button>
    </a>
      
  </li>

</ul>

    </div>
</section>

    }
    
<?php 
include_once 'footer.php';
?>



























































<!-- <div id="t3-content" class="t3-content col-xs-12">
						<div id="system-message-container">
	</div>

						<h1>Detaliile contului</h1>

	  <form action="/index.php?option=com_virtuemart&amp;view=user&amp;layout=edit&amp;language=ro-RO&amp;Itemid=259&amp;lang=ro-RO" method="post" name="login" id="form-login">
      Bun venit Cristian!      <input type="submit" name="Submit" class="button" value="Deconectare">
      <input type="hidden" name="option" value="com_users">
      <input type="hidden" name="task" value="user.logout">
      <input type="hidden" name="7a047f9d8eefd3622589b61ebd86ca35" value="1">    	<input type="hidden" name="return" value="aW5kZXgucGhwP29wdGlvbj1jb21fdmlydHVlbWFydCZ2aWV3PXVzZXImbGF5b3V0PWVkaXQmbGFuZ3VhZ2U9cm8tUk8mSXRlbWlkPTI1OSZsYW5nPXJvLVJP">
    </form>



<form method="post" id="adminForm" name="userForm" action="index.php?option=com_virtuemart&amp;view=user&amp;layout=edit&amp;language=ro-RO&amp;Itemid=259&amp;lang=ro-RO" class="form-validate">
<div id="ui-tabs"><ul id="tabs"><li class="current">Informaţii cumpărător</li></ul><div id="tab-1" class="tabs dyn-tabs" title="Informaţii cumpărător" style="display: block;">
<div class="buttonBar-right">

	

</div>



<fieldset>
	<legend class="userfields_info">
		Informaţii cumpărător	</legend>
	<table class="adminForm user-details">

				<tbody><tr>
			<td class="key">
				<label for="customer_number">
					Cod cumpărător:
				</label>
			</td>
			<td>
			 			</td>
		</tr>
				 	</tbody></table>
</fieldset>
			<fieldset>
			<legend class="userfields_info">Facturează către</legend>

			
			<table class="adminForm user-details">

						<tbody><tr title="E-mail">
					<td class="key">
						<label class="email" for="email_field">
							E-mail <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="email" id="email_field" name="email" size="30" value="cristian.eremia2000@gmail.com" class="required validate-email" maxlength="100" aria-required="true" required="required" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;"> 					</td>
				</tr>
					<tr title="Utilizator">
					<td class="key">
						<label class="username" for="username_field">
							Utilizator <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="username_field" name="username" size="30" value="" class="required" maxlength="25" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Numele Afişat">
					<td class="key">
						<label class="name" for="name_field">
							Numele Afişat <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="name_field" name="name" size="30" value="" class="required" maxlength="25" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Parolă">
					<td class="key">
						<label class="password" for="password_field">
							Parolă						</label>
					</td>
					<td>
						<input type="password" id="password_field" name="password" size="30" class="validate-password  inputbox" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACIUlEQVQ4EX2TOYhTURSG87IMihDsjGghBhFBmHFDHLWwSqcikk4RRKJgk0KL7C8bMpWpZtIqNkEUl1ZCgs0wOo0SxiLMDApWlgOPrH7/5b2QkYwX7jvn/uc//zl3edZ4PPbNGvF4fC4ajR5VrNvt/mo0Gr1ZPOtfgWw2e9Lv9+chX7cs64CS4Oxg3o9GI7tUKv0Q5o1dAiTfCgQCLwnOkfQOu+oSLyJ2A783HA7vIPLGxX0TgVwud4HKn0nc7Pf7N6vV6oZHkkX8FPG3uMfgXC0Wi2vCg/poUKGGcagQI3k7k8mcp5slcGswGDwpl8tfwGJg3xB6Dvey8vz6oH4C3iXcFYjbwiDeo1KafafkC3NjK7iL5ESFGQEUF7Sg+ifZdDp9GnMF/KGmfBdT2HCwZ7TwtrBPC7rQaav6Iv48rqZwg+F+p8hOMBj0IbxfMdMBrW5pAVGV/ztINByENkU0t5BIJEKRSOQ3Aj+Z57iFs1R5NK3EQS6HQqF1zmQdzpFWq3W42WwOTAf1er1PF2USFlC+qxMvFAr3HcexWX+QX6lUvsKpkTyPSEXJkw6MQ4S38Ljdbi8rmM/nY+CvgNcQqdH6U/xrYK9t244jZv6ByUOSiDdIfgBZ12U6dHEHu9TpdIr8F0OP692CtzaW/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
					</td>
				</tr>
					<tr title="Confirmă Parolă">
					<td class="key">
						<label class="password2" for="password2_field">
							Confirmă Parolă						</label>
					</td>
					<td>
						<input type="password" id="password2_field" name="password2" size="30" class="validate-password  inputbox" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACIUlEQVQ4EX2TOYhTURSG87IMihDsjGghBhFBmHFDHLWwSqcikk4RRKJgk0KL7C8bMpWpZtIqNkEUl1ZCgs0wOo0SxiLMDApWlgOPrH7/5b2QkYwX7jvn/uc//zl3edZ4PPbNGvF4fC4ajR5VrNvt/mo0Gr1ZPOtfgWw2e9Lv9+chX7cs64CS4Oxg3o9GI7tUKv0Q5o1dAiTfCgQCLwnOkfQOu+oSLyJ2A783HA7vIPLGxX0TgVwud4HKn0nc7Pf7N6vV6oZHkkX8FPG3uMfgXC0Wi2vCg/poUKGGcagQI3k7k8mcp5slcGswGDwpl8tfwGJg3xB6Dvey8vz6oH4C3iXcFYjbwiDeo1KafafkC3NjK7iL5ESFGQEUF7Sg+ifZdDp9GnMF/KGmfBdT2HCwZ7TwtrBPC7rQaav6Iv48rqZwg+F+p8hOMBj0IbxfMdMBrW5pAVGV/ztINByENkU0t5BIJEKRSOQ3Aj+Z57iFs1R5NK3EQS6HQqF1zmQdzpFWq3W42WwOTAf1er1PF2USFlC+qxMvFAr3HcexWX+QX6lUvsKpkTyPSEXJkw6MQ4S38Ljdbi8rmM/nY+CvgNcQqdH6U/xrYK9t244jZv6ByUOSiDdIfgBZ12U6dHEHu9TpdIr8F0OP692CtzaW/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
					</td>
				</tr>
					<tr title="Nume companie">
					<td class="key">
						<label class="company" for="company_field">
							Nume companie						</label>
					</td>
					<td>
						<input type="text" id="company_field" name="company" size="30" value="" maxlength="64"> 					</td>
				</tr>
					<tr title="Codul fiscal">
					<td class="key">
						<label class="vat_id" for="vat_id_field">
							Codul fiscal						</label>
					</td>
					<td>
						<input type="text" id="vat_id_field" name="vat_id" size="0" value="" maxlength="15"> 					</td>
				</tr>
					<tr title="Prenume">
					<td class="key">
						<label class="first_name" for="first_name_field">
							Prenume <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="first_name_field" name="first_name" size="30" value="" class="required" maxlength="32" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Nume">
					<td class="key">
						<label class="last_name" for="last_name_field">
							Nume <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="last_name_field" name="last_name" size="30" value="" class="required" maxlength="32" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Adresa">
					<td class="key">
						<label class="address_1" for="address_1_field">
							Adresa <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="address_1_field" name="address_1" size="30" value="" class="required" maxlength="64" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Adresa 2">
					<td class="key">
						<label class="address_2" for="address_2_field">
							Adresa 2						</label>
					</td>
					<td>
						<input type="text" id="address_2_field" name="address_2" size="30" value="" maxlength="64"> 					</td>
				</tr>
					<tr title="Cod poştal">
					<td class="key">
						<label class="zip" for="zip_field">
							Cod poştal <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="zip_field" name="zip" size="30" value="" class="required" maxlength="32" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Oraș">
					<td class="key">
						<label class="city" for="city_field">
							Oraș <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="city_field" name="city" size="30" value="" class="required" maxlength="32" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Ţară">
					<td class="key">
						<label class="virtuemart_country_id" for="virtuemart_country_id_field">
							Ţară <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<select id="virtuemart_country_id_field" name="virtuemart_country_id" class="vm-chzn-select required chzn-done" style="width: 210px; display: none;" aria-required="true" required="required">
	<option value="">selectare/derulare listă</option>
	<option value="175" selected="selected">Romania</option>
</select><div id="virtuemart_country_id_field_chzn" class="chzn-container chzn-container-single chzn-container-single-nosearch" style="width: 210px;"><a href="javascript:void(0)" class="chzn-single"><span>Romania</span><div><b></b></div></a><div class="chzn-drop" style="left: -9000px; width: 208px; top: 31px;"><div class="chzn-search"><input type="text" autocomplete="off" style="width: 173px;"></div><ul class="chzn-results"><li id="virtuemart_country_id_field_chzn_o_0" class="active-result" style="">selectare/derulare listă</li><li id="virtuemart_country_id_field_chzn_o_1" class="active-result result-selected" style="">Romania</li></ul></div></div>
					</td>
				</tr>
					<tr title="Județ/Sector">
					<td class="key">
						<label class="virtuemart_state_id" for="virtuemart_state_id_field">
							Județ/Sector <span class="asterisk" style="display: inline;">*</span>						</label>
					</td>
					<td>
						<select id="virtuemart_state_id_field" class="vm-chzn-select chzn-done" name="virtuemart_state_id" style="width: 210px; display: none;" required="required" aria-required="true">
						<option value="">selectare/derulare listă</option>
						<optgroup id="group-0-175" label="Romania"><option value="172">Alba</option><option value="173">Arad</option><option value="174">Argeș</option><option value="175">Bacău</option><option value="176">Bihor</option><option value="177">Bistrița-Năsăud</option><option value="178">Botoșani</option><option value="179">Brăila</option><option value="180">Brașov</option><option value="181">București - sector 1</option><option value="832">București - sector 2</option><option value="833">București - sector 3</option><option value="834">București - sector 4</option><option value="835">București - sector 5</option><option value="836">București - sector 6</option><option value="182">Buzău</option><option value="183">Călărași</option><option value="184">Caraș Severin</option><option value="185">Cluj</option><option value="186">Constanța</option><option value="187">Covasna</option><option value="188">Dâmbovița</option><option value="189">Dolj</option><option value="190">Galați</option><option value="191">Giurgiu</option><option value="192">Gorj</option><option value="193">Harghita</option><option value="194">Hunedoara</option><option value="195">Ialomița</option><option value="196">Iași</option><option value="197">Ilfov</option><option value="198">Maramureș</option><option value="199">Mehedinți</option><option value="200">Mureș</option><option value="201">Neamț</option><option value="202">Olt</option><option value="203">Prahova</option><option value="204">Sălaj</option><option value="205">Satu Mare</option><option value="206">Sibiu</option><option value="207">Suceava</option><option value="208">Teleorman</option><option value="209">Timiș</option><option value="210">Tulcea</option><option value="211">Vâlcea</option><option value="212">Vaslui</option><option value="213">Vrancea</option></optgroup></select><div id="virtuemart_state_id_field_chzn" class="chzn-container chzn-container-single" style="width: 210px;"><a href="javascript:void(0)" class="chzn-single"><span>selectare/derulare listă</span><div><b></b></div></a><div class="chzn-drop" style="left: -9000px; width: 208px; top: 31px;"><div class="chzn-search"><input type="text" autocomplete="off" style="width: 173px;"></div><ul class="chzn-results"><li id="virtuemart_state_id_field_chzn_o_0" class="active-result result-selected" style="">selectare/derulare listă</li><li id="virtuemart_state_id_field_chzn_g_1" class="group-result">Romania</li><li id="virtuemart_state_id_field_chzn_o_2" class="active-result group-option" style="">Alba</li><li id="virtuemart_state_id_field_chzn_o_3" class="active-result group-option" style="">Arad</li><li id="virtuemart_state_id_field_chzn_o_4" class="active-result group-option" style="">Argeș</li><li id="virtuemart_state_id_field_chzn_o_5" class="active-result group-option" style="">Bacău</li><li id="virtuemart_state_id_field_chzn_o_6" class="active-result group-option" style="">Bihor</li><li id="virtuemart_state_id_field_chzn_o_7" class="active-result group-option" style="">Bistrița-Năsăud</li><li id="virtuemart_state_id_field_chzn_o_8" class="active-result group-option" style="">Botoșani</li><li id="virtuemart_state_id_field_chzn_o_9" class="active-result group-option" style="">Brăila</li><li id="virtuemart_state_id_field_chzn_o_10" class="active-result group-option" style="">Brașov</li><li id="virtuemart_state_id_field_chzn_o_11" class="active-result group-option" style="">București - sector 1</li><li id="virtuemart_state_id_field_chzn_o_12" class="active-result group-option" style="">București - sector 2</li><li id="virtuemart_state_id_field_chzn_o_13" class="active-result group-option" style="">București - sector 3</li><li id="virtuemart_state_id_field_chzn_o_14" class="active-result group-option" style="">București - sector 4</li><li id="virtuemart_state_id_field_chzn_o_15" class="active-result group-option" style="">București - sector 5</li><li id="virtuemart_state_id_field_chzn_o_16" class="active-result group-option" style="">București - sector 6</li><li id="virtuemart_state_id_field_chzn_o_17" class="active-result group-option" style="">Buzău</li><li id="virtuemart_state_id_field_chzn_o_18" class="active-result group-option" style="">Călărași</li><li id="virtuemart_state_id_field_chzn_o_19" class="active-result group-option" style="">Caraș Severin</li><li id="virtuemart_state_id_field_chzn_o_20" class="active-result group-option" style="">Cluj</li><li id="virtuemart_state_id_field_chzn_o_21" class="active-result group-option" style="">Constanța</li><li id="virtuemart_state_id_field_chzn_o_22" class="active-result group-option" style="">Covasna</li><li id="virtuemart_state_id_field_chzn_o_23" class="active-result group-option" style="">Dâmbovița</li><li id="virtuemart_state_id_field_chzn_o_24" class="active-result group-option" style="">Dolj</li><li id="virtuemart_state_id_field_chzn_o_25" class="active-result group-option" style="">Galați</li><li id="virtuemart_state_id_field_chzn_o_26" class="active-result group-option" style="">Giurgiu</li><li id="virtuemart_state_id_field_chzn_o_27" class="active-result group-option" style="">Gorj</li><li id="virtuemart_state_id_field_chzn_o_28" class="active-result group-option" style="">Harghita</li><li id="virtuemart_state_id_field_chzn_o_29" class="active-result group-option" style="">Hunedoara</li><li id="virtuemart_state_id_field_chzn_o_30" class="active-result group-option" style="">Ialomița</li><li id="virtuemart_state_id_field_chzn_o_31" class="active-result group-option" style="">Iași</li><li id="virtuemart_state_id_field_chzn_o_32" class="active-result group-option" style="">Ilfov</li><li id="virtuemart_state_id_field_chzn_o_33" class="active-result group-option" style="">Maramureș</li><li id="virtuemart_state_id_field_chzn_o_34" class="active-result group-option" style="">Mehedinți</li><li id="virtuemart_state_id_field_chzn_o_35" class="active-result group-option" style="">Mureș</li><li id="virtuemart_state_id_field_chzn_o_36" class="active-result group-option" style="">Neamț</li><li id="virtuemart_state_id_field_chzn_o_37" class="active-result group-option" style="">Olt</li><li id="virtuemart_state_id_field_chzn_o_38" class="active-result group-option" style="">Prahova</li><li id="virtuemart_state_id_field_chzn_o_39" class="active-result group-option" style="">Sălaj</li><li id="virtuemart_state_id_field_chzn_o_40" class="active-result group-option" style="">Satu Mare</li><li id="virtuemart_state_id_field_chzn_o_41" class="active-result group-option" style="">Sibiu</li><li id="virtuemart_state_id_field_chzn_o_42" class="active-result group-option" style="">Suceava</li><li id="virtuemart_state_id_field_chzn_o_43" class="active-result group-option" style="">Teleorman</li><li id="virtuemart_state_id_field_chzn_o_44" class="active-result group-option" style="">Timiș</li><li id="virtuemart_state_id_field_chzn_o_45" class="active-result group-option" style="">Tulcea</li><li id="virtuemart_state_id_field_chzn_o_46" class="active-result group-option" style="">Vâlcea</li><li id="virtuemart_state_id_field_chzn_o_47" class="active-result group-option" style="">Vaslui</li><li id="virtuemart_state_id_field_chzn_o_48" class="active-result group-option" style="">Vrancea</li></ul></div></div>					</td>
				</tr>
					<tr title="Telefon">
					<td class="key">
						<label class="phone_1" for="phone_1_field">
							Telefon						</label>
					</td>
					<td>
						<input type="text" id="phone_1_field" name="phone_1" size="30" value="" maxlength="32"> 					</td>
				</tr>
					<tr title="Telefon Mobil">
					<td class="key">
						<label class="phone_2" for="phone_2_field">
							Telefon Mobil <span class="asterisk">*</span>						</label>
					</td>
					<td>
						<input type="text" id="phone_2_field" name="phone_2" size="30" value="" class="required" maxlength="32" aria-required="true" required="required"> 					</td>
				</tr>
					<tr title="Fax">
					<td class="key">
						<label class="fax" for="fax_field">
							Fax						</label>
					</td>
					<td>
						<input type="text" id="fax_field" name="fax" size="30" value="" maxlength="32"> 					</td>
				</tr>
		</tbody></table>
	</fieldset>
	
			
		



<fieldset>
    <legend>
	<span class="userfields_info">Livrează la</span>    </legend>
    <a href="/addst?7a047f9d8eefd3622589b61ebd86ca35=1&amp;new=1&amp;virtuemart_user_id[0]=652"><span class="vmicon vmicon-16-editadd"></span> Adăugare/Editare adresă de livrare </a><ul></ul>
</fieldset>

<input type="hidden" name="task" value="saveUser">
<input type="hidden" name="address_type" value="BT">

<div class="buttonBar-right">
	<button class="button" type="submit" onclick="javascript:return myValidator(userForm, true);window.location='/contul-meu/cos-de-cumparaturi';">Salvare</button>
	&nbsp;
	<button class="button" type="reset" onclick="window.location='/contul-meu/cos-de-cumparaturi';">Închide</button>
</div>
<div class="clear"></div>
			    </div></div><input type="hidden" name="option" value="com_virtuemart">
<input type="hidden" name="controller" value="user">
<input type="hidden" name="7a047f9d8eefd3622589b61ebd86ca35" value="1"></form>



</div> -->