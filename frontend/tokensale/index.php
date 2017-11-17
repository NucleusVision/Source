<!DOCTYPE HTML>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0" />
    <title>Nucleus - Token Sale</title>
    <link rel="stylesheet" href="css/register.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700,900" rel="stylesheet" type="text/css" />
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16" />
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&amp;render=explicit' type="text/javascript">
    </script>
  </head>
  <body class="all-sections-bg">
    <div id="main-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 content">
            <div id="errModal" class="modal fade" tabindex="-1"
            role="dialog" data-backdrop="static">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body"></div><button id="modal-btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
            <div id="exampleModal" class="modal fade" tabindex="-1"
            role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="example-modal-body">
                    <img src="img/passport.png" />
                  </div><button type="button" class=
                  "btn btn-default" data-dismiss=
                  "modal">Close</button>
                </div>
              </div>
            </div><img class="nucleus-logo" src=
            "img/nucleus-icon.png" />
            <h1 id="registration-header">
              Nucleus Token Sale Registration
            </h1>
            <div id="account-header">
              <h1>
                Your Account Profile
              </h1>
              <h5>
                All fields are required for our KYC process
              </h5>
            </div>
            <div id="registration">
              <div id="tabs">
                <div class="col-xs-4 address-tab">
                  Address
                </div>
                <div class="col-xs-4 details-tab">
                  Personal Details
                </div>
                <div class="col-xs-4 submit-tab">
                  Submit
                </div>
              </div>
              <div id="email">
                <h5>
                  Please enter your email to start. This is a
                  one-time process so please have your personal
                  details and identity documents ready.
                </h5>
                <h6>
                  Please enable javascript in your browser to fill
                  out the form.
                </h6>
                <form id="email-form" role="form" data-toggle=
                "validator">
                  <div class="form-group">
                    <input type="hidden" id="UserAgent" />
                    <input class="form-control" id="email-input"
                    type="email" placeholder="email@example.com" />
                  </div>
                  <div id="g-recaptcha1" class="g-recaptcha"
                  data-callback="recaptchaResponse1" data-type=
                  "image"></div><button class=
                  "btn btn-lg btn-block btn-bb" type=
                  "submit">Submit</button>
                </form>
                <p id="recaptcha1-msg"></p>
                <p id="email-form-msg" class="email-msg"></p>
              </div>
              <div id="code">
                <h3 class="heading-2 yellow">
                  Enter Verification Code
                </h3>
                <h5>
                  We have sent a one-time verification code to your
                  email. Please check and enter the code to setup
                  your account.
                </h5>
                <form id="code-form">
                  <div class="form-group">
                    <input class="form-control" id="code-input"
                    placeholder="Enter Verification Code" />
                  </div>
                  <div id="g-recaptcha2" class="g-recaptcha"
                  data-callback="recaptchaResponse2">
                  </div><button class="btn btn-lg btn-block btn-bb"
                  type="submit">Submit</button>
                </form>
                <p id="recaptcha2-msg"></p>
                <p id="code-form-msg" class="code-msg"></p>
              </div>
              <div id="account">
                <div id="countdownExample" class="col-xs-12">
                  <p>
                    Time to complete registration:
                  </p>
                  <div class="values"></div>
                </div>
                <form id="account-form" novalidate="">
                  <div id="eth-address">
                    <p>
                      ETH address must be ERC-20 compliant
                    </p>
                    <p>
                      The Ethereum wallet address should be the one
                      you will be contributing ETH from and must be
                      ERC-20 compatible. This will be the same
                      Ethereum wallet address you will receive the
                      Nucleus tokens.
                    </p>
                    
                    
                    <!--
                    <h3 class="announcement">
                      <span class="bold">DO NOT USE</span>
                      COINBASE, BITTREX OR ANY OTHER
                      <span>EXCHANGE</span> AS IT IS NOT ERC-20
                      TOKEN FRIENDLY. WE HIGHLY RECOMMEND
                      https://myetherwallet.com/.
                    </h3>
                    -->
                    <div class="form-group">
                        <div class="eth-box-cnt">  
                            <div class="eth-box-cnt-b1">
                                ETH Wallet (Required)
                            </div>
                            <div class="eth-box-cnt-b2">
                                <input class="form-control acct-input" id=
                                "addressInput" placeholder="0xj900900" />
                            </div>
                            <div class="eth-box-cnt-b3">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!--
                    <p>
                      Do not use addresses from exchanges you may
                      not receive any Nucleus Token from. CakeCodes
                      Global SEZC, Inc. disclaims all
                      responsibility and liability to you if you
                      use exchange wallet, or other intermediary
                      and do not receive Nucleus Tokens.
                    </p>
                    -->
                    
                    <p>
                     The Bitcoin Wallet Address Should be the one you will be contributing BTC from.Please enter a valid Ethereum wallet address above to receive the Nucleus tokens.
                    </p>
                    
                    <div class="form-group">
                        <div class="bitcoin-box-cnt">  
                            <div class="bitcoin-box-cnt-b1">
                                BTC Wallet (Optional)
                            </div>
                            <div class="bitcoin-box-cnt-b2">
                                <input class="form-control bc-acct-input" id=
                                "bcaddressInput" placeholder="1HB5XM" />
                            </div>
                            <div class="bitcoin-box-cnt-b3">
                                
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn next-btn" type=
                    "button" onclick="nextStep1()">Next</button>
                    <p id="eth-address-msg"></p>
                  </div>
                  <div id="personal-details">
                    <div class="form-group">
                      <label>First Name</label> <input class=
                      "form-control acct-input" id="firstName"
                      placeholder="First name" required="" />
                      <label>Last Name</label> <input class=
                      "form-control acct-input" id="lastName"
                      placeholder="Last name" required="" />
                      <label>Date of birth</label> <input class=
                      "form-control acct-input" id="datepicker"
                      placeholder="mm/dd/yyyy" />
                      <div id="select-boxes">
                        <div id="nationality-box" class="col-xs-6">
                          <label>Nationality</label> <select id=
                          "nationality" name="nationality" class=
                          "acct-input">
                            <option value="">
                              -- select one --
                            </option>
                            <option value="ABKHAZIAN">
                              ABKHAZIAN
                            </option>
                            <option value="AFGHANI">
                              AFGHANI
                            </option>
                            <option value="ALANDIC">
                              ALANDIC
                            </option>
                            <option value="ALBANIAN">
                              ALBANIAN
                            </option>
                            <option value="ALGERIAN">
                              ALGERIAN
                            </option>
                            <option value="ANDORRAN">
                              ANDORRAN
                            </option>
                            <option value="ANGOLAN">
                              ANGOLAN
                            </option>
                            <option value="ANTARCTIC">
                              ANTARCTIC
                            </option>
                            <option value="ANTIGUAN">
                              ANTIGUAN
                            </option>
                            <option value="ARGENTINE">
                              ARGENTINE
                            </option>
                            <option value="ARMENIAN">
                              ARMENIAN
                            </option>
                            <option value="ARUBIAN">
                              ARUBIAN
                            </option>
                            <option value="ASCENSION">
                              ASCENSION
                            </option>
                            <option value=
                            "AUSTRALIAN EXTERNAL TERRITORY">
                              AUSTRALIAN EXTERNAL TERRITORY
                            </option>
                            <option value="AUSTRALIAN">
                              AUSTRALIAN
                            </option>
                            <option value=
                            "AUSTRALIAN ANTARCTIC TERRITORY">
                              AUSTRALIAN ANTARCTIC TERRITORY
                            </option>
                            <option value="AUSTRIAN">
                              AUSTRIAN
                            </option>
                            <option value="AZERBAIJANI">
                              AZERBAIJANI
                            </option>
                            <option value="BAHAMEESE">
                              BAHAMEESE
                            </option>
                            <option value="BAHRAINIAN">
                              BAHRAINIAN
                            </option>
                            <option value="BAKER ISLAND">
                              BAKER ISLAND
                            </option>
                            <option value="BANGLADESHI">
                              BANGLADESHI
                            </option>
                            <option value="BARBADIAN">
                              BARBADIAN
                            </option>
                            <option value="BELARUSIAN">
                              BELARUSIAN
                            </option>
                            <option value="BELGIAN">
                              BELGIAN
                            </option>
                            <option value="BELIZEAN">
                              BELIZEAN
                            </option>
                            <option value="BENINESE">
                              BENINESE
                            </option>
                            <option value="BHUTANESE">
                              BHUTANESE
                            </option>
                            <option value="BOLIVIAN">
                              BOLIVIAN
                            </option>
                            <option value="BOSNIAN">
                              BOSNIAN
                            </option>
                            <option value="MOTSWANA">
                              MOTSWANA
                            </option>
                            <option value="BOUVET ISLAND">
                              BOUVET ISLAND
                            </option>
                            <option value="BRAZILIAN">
                              BRAZILIAN
                            </option>
                            <option value=
                            "BRITISH ANTARCTIC TERRITORY">
                              BRITISH ANTARCTIC TERRITORY
                            </option>
                            <option value=
                            "BRITISH INDIAN OCEAN TERRITORY">
                              BRITISH INDIAN OCEAN TERRITORY
                            </option>
                            <option value=
                            "BRITISH SOVEREIGN BASE AREAS">
                              BRITISH SOVEREIGN BASE AREAS
                            </option>
                            <option value=
                            "BRITISH OVERSEAS TERRITORY">
                              BRITISH OVERSEAS TERRITORY
                            </option>
                            <option value="BRITISH">
                              BRITISH
                            </option>
                            <option value="BRUNEIAN">
                              BRUNEIAN
                            </option>
                            <option value="BULGARIAN">
                              BULGARIAN
                            </option>
                            <option value="BURKINABE">
                              BURKINABE
                            </option>
                            <option value="MYANMAR">
                              MYANMAR
                            </option>
                            <option value="BURUNDIAN">
                              BURUNDIAN
                            </option>
                            <option value="CAMBODIAN">
                              CAMBODIAN
                            </option>
                            <option value="CAMEROONIAN">
                              CAMEROONIAN
                            </option>
                            <option value="CANADIAN">
                              CANADIAN
                            </option>
                            <option value="CAPE VERDEAN">
                              CAPE VERDEAN
                            </option>
                            <option value="CARIBBEAN NETHERLANDS">
                              CARIBBEAN NETHERLANDS
                            </option>
                            <option value="CENTRAL AFRICAN">
                              CENTRAL AFRICAN
                            </option>
                            <option value="CHADIAN">
                              CHADIAN
                            </option>
                            <option value="CHILEAN">
                              CHILEAN
                            </option>
                            <option value="CHINESE">
                              CHINESE
                            </option>
                            <option value="CLIPPERTON ISLAND">
                              CLIPPERTON ISLAND
                            </option>
                            <option value="COLOMBIAN">
                              COLOMBIAN
                            </option>
                            <option value="COMORAN">
                              COMORAN
                            </option>
                            <option value="CONGOLESE">
                              CONGOLESE
                            </option>
                            <option value="COOK ISLANDER">
                              COOK ISLANDER
                            </option>
                            <option value="COSTA RICAN">
                              COSTA RICAN
                            </option>
                            <option value="IVORIAN">
                              IVORIAN
                            </option>
                            <option value="CROATIAN">
                              CROATIAN
                            </option>
                            <option value="CUBAN">
                              CUBAN
                            </option>
                            <option value="CURACAOAN">
                              CURACAOAN
                            </option>
                            <option value="CYPRIOT">
                              CYPRIOT
                            </option>
                            <option value="CZECH">
                              CZECH
                            </option>
                            <option value="CONGOLESE">
                              CONGOLESE
                            </option>
                            <option value="DANISH">
                              DANISH
                            </option>
                            <option value="DJIBOUTIAN">
                              DJIBOUTIAN
                            </option>
                            <option value="DOMINICAN">
                              DOMINICAN
                            </option>
                            <option value="DOMINICAN">
                              DOMINICAN
                            </option>
                            <option value="ECUADOREAN">
                              ECUADOREAN
                            </option>
                            <option value="EGYPTIAN">
                              EGYPTIAN
                            </option>
                            <option value="SALVADOREAN">
                              SALVADOREAN
                            </option>
                            <option value="EQUATORIAL GUINEAN">
                              EQUATORIAL GUINEAN
                            </option>
                            <option value="ERITREAN">
                              ERITREAN
                            </option>
                            <option value="ESTONIAN">
                              ESTONIAN
                            </option>
                            <option value="ETHIOPIAN">
                              ETHIOPIAN
                            </option>
                            <option value="FAROESE">
                              FAROESE
                            </option>
                            <option value="FIJIAN">
                              FIJIAN
                            </option>
                            <option value="FINNISH">
                              FINNISH
                            </option>
                            <option value="FRENCH">
                              FRENCH
                            </option>
                            <option value="FRENCH GUIANESE">
                              FRENCH GUIANESE
                            </option>
                            <option value=
                            "FRENCH OVERSEAS COLLECTIVITY">
                              FRENCH OVERSEAS COLLECTIVITY
                            </option>
                            <option value=
                            "FRENCH SOUTHERN AND ANTARCTIC LANDS">
                              FRENCH SOUTHERN AND ANTARCTIC LANDS
                            </option>
                            <option value=
                            "FRENCH SOUTHERN TERRITORIES">
                              FRENCH SOUTHERN TERRITORIES
                            </option>
                            <option value="GABONESE">
                              GABONESE
                            </option>
                            <option value="GAMBIAN">
                              GAMBIAN
                            </option>
                            <option value="GEORGIAN">
                              GEORGIAN
                            </option>
                            <option value="GERMAN">
                              GERMAN
                            </option>
                            <option value="GHANAIAN">
                              GHANAIAN
                            </option>
                            <option value="GIBRALTARIAN">
                              GIBRALTARIAN
                            </option>
                            <option value="GREEK">
                              GREEK
                            </option>
                            <option value="GREENLANDER">
                              GREENLANDER
                            </option>
                            <option value="GRENADIAN">
                              GRENADIAN
                            </option>
                            <option value="GUADELOUPEAN">
                              GUADELOUPEAN
                            </option>
                            <option value="GUAMANIAN">
                              GUAMANIAN
                            </option>
                            <option value="GUATEMALAN">
                              GUATEMALAN
                            </option>
                            <option value="GUERNSEY">
                              GUERNSEY
                            </option>
                            <option value="GUINEAN">
                              GUINEAN
                            </option>
                            <option value="GUINEAN">
                              GUINEAN
                            </option>
                            <option value="GUYANESE">
                              GUYANESE
                            </option>
                            <option value="HAITIAN">
                              HAITIAN
                            </option>
                            <option value="HONDURAN">
                              HONDURAN
                            </option>
                            <option value="HONG KONG">
                              HONG KONG
                            </option>
                            <option value="HOWLAND ISLAND">
                              HOWLAND ISLAND
                            </option>
                            <option value="HUNGARIAN">
                              HUNGARIAN
                            </option>
                            <option value="ICELANDER">
                              ICELANDER
                            </option>
                            <option value="INDIAN">
                              INDIAN
                            </option>
                            <option value="INDONESIAN">
                              INDONESIAN
                            </option>
                            <option value="IRANIAN">
                              IRANIAN
                            </option>
                            <option value="IRAQI">
                              IRAQI
                            </option>
                            <option value="IRISH">
                              IRISH
                            </option>
                            <option value="MANX">
                              MANX
                            </option>
                            <option value="ISRAELI">
                              ISRAELI
                            </option>
                            <option value="ITALIAN">
                              ITALIAN
                            </option>
                            <option value="JAMAICAN">
                              JAMAICAN
                            </option>
                            <option value="JAPANESE">
                              JAPANESE
                            </option>
                            <option value="JARVIS ISLAND">
                              JARVIS ISLAND
                            </option>
                            <option value="JERSEY">
                              JERSEY
                            </option>
                            <option value="JOHNSTON ATOLL">
                              JOHNSTON ATOLL
                            </option>
                            <option value="JORDANIAN">
                              JORDANIAN
                            </option>
                            <option value="KAZAKHSTANI">
                              KAZAKHSTANI
                            </option>
                            <option value="KENYAN">
                              KENYAN
                            </option>
                            <option value="KINGMAN REEF">
                              KINGMAN REEF
                            </option>
                            <option value="I-KIRIBATI">
                              I-KIRIBATI
                            </option>
                            <option value="KOSOVAR">
                              KOSOVAR
                            </option>
                            <option value="KUWAITI">
                              KUWAITI
                            </option>
                            <option value="KYRGYZSTANI">
                              KYRGYZSTANI
                            </option>
                            <option value="LAOTIAN">
                              LAOTIAN
                            </option>
                            <option value="LATVIAN">
                              LATVIAN
                            </option>
                            <option value="LEBANESE">
                              LEBANESE
                            </option>
                            <option value="MOSOTHO">
                              MOSOTHO
                            </option>
                            <option value="LIBERIAN">
                              LIBERIAN
                            </option>
                            <option value="LIBYAN">
                              LIBYAN
                            </option>
                            <option value="LIECHTENSTEINER">
                              LIECHTENSTEINER
                            </option>
                            <option value="LITHUNIAN">
                              LITHUNIAN
                            </option>
                            <option value="LUXEMBOURGER">
                              LUXEMBOURGER
                            </option>
                            <option value="MACANESE">
                              MACANESE
                            </option>
                            <option value="MACEDONIAN">
                              MACEDONIAN
                            </option>
                            <option value="MALAGASY">
                              MALAGASY
                            </option>
                            <option value="MALAWIAN">
                              MALAWIAN
                            </option>
                            <option value="MALAYSIAN">
                              MALAYSIAN
                            </option>
                            <option value="MALDIVAN">
                              MALDIVAN
                            </option>
                            <option value="MALIAN">
                              MALIAN
                            </option>
                            <option value="MALTESE">
                              MALTESE
                            </option>
                            <option value="MARSHALLESE">
                              MARSHALLESE
                            </option>
                            <option value="MARTINICAN">
                              MARTINICAN
                            </option>
                            <option value="MAURITANIAN">
                              MAURITANIAN
                            </option>
                            <option value="MAURITIAN">
                              MAURITIAN
                            </option>
                            <option value="MAHORAN">
                              MAHORAN
                            </option>
                            <option value="MEXICAN">
                              MEXICAN
                            </option>
                            <option value="MICRONESIAN">
                              MICRONESIAN
                            </option>
                            <option value="MOLDOVAN">
                              MOLDOVAN
                            </option>
                            <option value="MONACAN">
                              MONACAN
                            </option>
                            <option value="MONGOLIAN">
                              MONGOLIAN
                            </option>
                            <option value="MONTENEGRIN">
                              MONTENEGRIN
                            </option>
                            <option value="MONTSERRATIAN">
                              MONTSERRATIAN
                            </option>
                            <option value="MOROCCAN">
                              MOROCCAN
                            </option>
                            <option value="MOZAMBICAN">
                              MOZAMBICAN
                            </option>
                            <option value="NAGORNO-KARABAKH">
                              NAGORNO-KARABAKH
                            </option>
                            <option value="NAMIBIAN">
                              NAMIBIAN
                            </option>
                            <option value="NAURUAN">
                              NAURUAN
                            </option>
                            <option value="NAVASSA ISLAND">
                              NAVASSA ISLAND
                            </option>
                            <option value="NEPALESE">
                              NEPALESE
                            </option>
                            <option value="DUTCH">
                              DUTCH
                            </option>
                            <option value="NEW CALEDONIAN">
                              NEW CALEDONIAN
                            </option>
                            <option value="NEW ZEALANDER">
                              NEW ZEALANDER
                            </option>
                            <option value="NICARAGUAN">
                              NICARAGUAN
                            </option>
                            <option value="NIGERIEN">
                              NIGERIEN
                            </option>
                            <option value="NIGERIAN">
                              NIGERIAN
                            </option>
                            <option value="NIUEAN">
                              NIUEAN
                            </option>
                            <option value="NORFOLK ISLANDER">
                              NORFOLK ISLANDER
                            </option>
                            <option value="NORTH KOREAN">
                              NORTH KOREAN
                            </option>
                            <option value="NORWEGIAN">
                              NORWEGIAN
                            </option>
                            <option value="OMANI">
                              OMANI
                            </option>
                            <option value="PAKISTANI">
                              PAKISTANI
                            </option>
                            <option value="PALAUAN">
                              PALAUAN
                            </option>
                            <option value="PALESTINIAN">
                              PALESTINIAN
                            </option>
                            <option value="PALMYRA ATOLL">
                              PALMYRA ATOLL
                            </option>
                            <option value="PANAMANIAN">
                              PANAMANIAN
                            </option>
                            <option value="PAPUA NEW GUINEAN">
                              PAPUA NEW GUINEAN
                            </option>
                            <option value="PARAGUAYAN">
                              PARAGUAYAN
                            </option>
                            <option value="PERUVIAN">
                              PERUVIAN
                            </option>
                            <option value="PETER I ISLAND">
                              PETER I ISLAND
                            </option>
                            <option value="FILIPINO">
                              FILIPINO
                            </option>
                            <option value="PITCAIRN ISLANDER">
                              PITCAIRN ISLANDER
                            </option>
                            <option value="POLISH">
                              POLISH
                            </option>
                            <option value="PORTUGUESE">
                              PORTUGUESE
                            </option>
                            <option value=
                            "PRIDNESTROVIE (TRANSNISTRIA)">
                              PRIDNESTROVIE (TRANSNISTRIA)
                            </option>
                            <option value="PUERTO RICAN">
                              PUERTO RICAN
                            </option>
                            <option value="QATARI">
                              QATARI
                            </option>
                            <option value="QUEEN MAUD LAND">
                              QUEEN MAUD LAND
                            </option>
                            <option value="FRENCH OVERSEAS REGION">
                              FRENCH OVERSEAS REGION
                            </option>
                            <option value="ROMANIAN">
                              ROMANIAN
                            </option>
                            <option value="ROSS DEPENDENCY">
                              ROSS DEPENDENCY
                            </option>
                            <option value="RUSSIAN">
                              RUSSIAN
                            </option>
                            <option value="RWANDAN">
                              RWANDAN
                            </option>
                            <option value="KITTIAN">
                              KITTIAN
                            </option>
                            <option value="SAINT LUCIAN">
                              SAINT LUCIAN
                            </option>
                            <option value="DUTCH">
                              DUTCH
                            </option>
                            <option value="SAINT-PIERRAIS">
                              SAINT-PIERRAIS
                            </option>
                            <option value="SAINT VINCENTIAN">
                              SAINT VINCENTIAN
                            </option>
                            <option value="SAMOAN">
                              SAMOAN
                            </option>
                            <option value="SANMARINESE">
                              SANMARINESE
                            </option>
                            <option value="SAO TOMEAN">
                              SAO TOMEAN
                            </option>
                            <option value="SAUDI ARABIAN">
                              SAUDI ARABIAN
                            </option>
                            <option value="SENEGALESE">
                              SENEGALESE
                            </option>
                            <option value="SERBIAN">
                              SERBIAN
                            </option>
                            <option value="SEYCHELLOIS">
                              SEYCHELLOIS
                            </option>
                            <option value="SIERRA LEONEAN">
                              SIERRA LEONEAN
                            </option>
                            <option value="SINGAPOREAN">
                              SINGAPOREAN
                            </option>
                            <option value="SLOVAKIAN">
                              SLOVAKIAN
                            </option>
                            <option value="SLOVENIAN">
                              SLOVENIAN
                            </option>
                            <option value="SOLOMON ISLANDER">
                              SOLOMON ISLANDER
                            </option>
                            <option value="SOMALI">
                              SOMALI
                            </option>
                            <option value="SOMALILAND">
                              SOMALILAND
                            </option>
                            <option value="SOUTH AFRICAN">
                              SOUTH AFRICAN
                            </option>
                            <option value="SOUTH KOREAN">
                              SOUTH KOREAN
                            </option>
                            <option value="SOUTH OSSETIA">
                              SOUTH OSSETIA
                            </option>
                            <option value="SOUTH SUDANESE">
                              SOUTH SUDANESE
                            </option>
                            <option value="SPANISH">
                              SPANISH
                            </option>
                            <option value="SRI LANKAN">
                              SRI LANKAN
                            </option>
                            <option value="SUDANESE">
                              SUDANESE
                            </option>
                            <option value="SURINAMER">
                              SURINAMER
                            </option>
                            <option value=
                            "SVALBARD AND JAN MAYEN ISLANDS">
                              SVALBARD AND JAN MAYEN ISLANDS
                            </option>
                            <option value="SWAZI">
                              SWAZI
                            </option>
                            <option value="SWEDISH">
                              SWEDISH
                            </option>
                            <option value="SWISS">
                              SWISS
                            </option>
                            <option value="SYRIAN">
                              SYRIAN
                            </option>
                            <option value="TAIWANESE">
                              TAIWANESE
                            </option>
                            <option value="TAJIKISTANI">
                              TAJIKISTANI
                            </option>
                            <option value="TANZANIAN">
                              TANZANIAN
                            </option>
                            <option value="THAI">
                              THAI
                            </option>
                            <option value="TIMORESE">
                              TIMORESE
                            </option>
                            <option value="TOGOLESE">
                              TOGOLESE
                            </option>
                            <option value="TOKELAUAN">
                              TOKELAUAN
                            </option>
                            <option value="TONGAN">
                              TONGAN
                            </option>
                            <option value="TRINIDADIAN">
                              TRINIDADIAN
                            </option>
                            <option value="TRISTAN DA CUNHA">
                              TRISTAN DA CUNHA
                            </option>
                            <option value="TUNISIAN">
                              TUNISIAN
                            </option>
                            <option value="TURKISH">
                              TURKISH
                            </option>
                            <option value="TURKMEN">
                              TURKMEN
                            </option>
                            <option value="TUVALUAN">
                              TUVALUAN
                            </option>
                            <option value="UGANDAN">
                              UGANDAN
                            </option>
                            <option value="UKRAINIAN">
                              UKRAINIAN
                            </option>
                            <option value="EMIRIAN">
                              EMIRIAN
                            </option>
                            <option value="AMERICAN">
                              AMERICAN
                            </option>
                            <option value="AMERICAN">
                              UNITED STATES
                            </option>
                            <option value="U.S. TERRITORY">
                              U.S. TERRITORY
                            </option>
                            <option value="URUGUAYAN">
                              URUGUAYAN
                            </option>
                            <option value="UZBEKISTANI">
                              UZBEKISTANI
                            </option>
                            <option value="NI-VANUATU">
                              NI-VANUATU
                            </option>
                            <option value="VATICAN">
                              VATICAN
                            </option>
                            <option value="VENEZUELAN">
                              VENEZUELAN
                            </option>
                            <option value="VIETNAMESE">
                              VIETNAMESE
                            </option>
                            <option value="WAKE ISLAND">
                              WAKE ISLAND
                            </option>
                            <option value="WESTERN SAHARAN">
                              WESTERN SAHARAN
                            </option>
                            <option value="YEMENI">
                              YEMENI
                            </option>
                            <option value="ZAMBIAN">
                              ZAMBIAN
                            </option>
                            <option value="ZIMBABWEAN">
                              ZIMBABWEAN
                            </option>
                            <option value="UNKNOWN">
                              UNKNOWN
                            </option>
                          </select>
                        </div>
                        <div class="col-xs-6">
                          <div id="gender-box">
                            <label>Gender</label> <select id=
                            "gender-select-box" class="acct-input">
                              <option value="">
                                -- select one --
                              </option>
                              <option value="Male" title="Male">
                                Male
                              </option>
                              <option value="Female" title=
                              "Female">
                                Female
                              </option>
                            </select>
                          </div>
                        </div>
                      </div><label>Country of Residence</label>
                      <select id="residence" class=
                      "acct-input form-control">
                        <option value="">
                          -- select one --
                        </option>
                        <option value="ABKHAZIA">
                          ABKHAZIA
                        </option>
                        <option value="AFGHANISTAN">
                          AFGHANISTAN
                        </option>
                        <option value="ALAND ISLANDS">
                          ALAND ISLANDS
                        </option>
                        <option value="ALBANIA">
                          ALBANIA
                        </option>
                        <option value="ALGERIA">
                          ALGERIA
                        </option>
                        <option value="AMERICAN SAMOA">
                          AMERICAN SAMOA
                        </option>
                        <option value="ANDORRA">
                          ANDORRA
                        </option>
                        <option value="ANGOLA">
                          ANGOLA
                        </option>
                        <option value="ANGUILLA">
                          ANGUILLA
                        </option>
                        <option value="ANTARCTICA">
                          ANTARCTICA
                        </option>
                        <option value="ANTIGUA AND BARBUDA">
                          ANTIGUA AND BARBUDA
                        </option>
                        <option value="ARGENTINA">
                          ARGENTINA
                        </option>
                        <option value="ARMENIA">
                          ARMENIA
                        </option>
                        <option value="ARUBA">
                          ARUBA
                        </option>
                        <option value="ASCENSION">
                          ASCENSION
                        </option>
                        <option value=
                        "ASHMORE AND CARTIER ISLANDS">
                          ASHMORE AND CARTIER ISLANDS
                        </option>
                        <option value="AUSTRALIA">
                          AUSTRALIA
                        </option>
                        <option value=
                        "AUSTRALIAN ANTARCTIC TERRITORY">
                          AUSTRALIAN ANTARCTIC TERRITORY
                        </option>
                        <option value="AUSTRIA">
                          AUSTRIA
                        </option>
                        <option value="AZERBAIJAN">
                          AZERBAIJAN
                        </option>
                        <option value="BAHAMAS">
                          BAHAMAS
                        </option>
                        <option value="BAHRAIN">
                          BAHRAIN
                        </option>
                        <option value="BAKER ISLAND">
                          BAKER ISLAND
                        </option>
                        <option value="BANGLADESH">
                          BANGLADESH
                        </option>
                        <option value="BARBADOS">
                          BARBADOS
                        </option>
                        <option value="BELARUS">
                          BELARUS
                        </option>
                        <option value="BELGIUM">
                          BELGIUM
                        </option>
                        <option value="BELIZE">
                          BELIZE
                        </option>
                        <option value="BENIN">
                          BENIN
                        </option>
                        <option value="BERMUDA">
                          BERMUDA
                        </option>
                        <option value="BHUTAN">
                          BHUTAN
                        </option>
                        <option value="BOLIVIA">
                          BOLIVIA
                        </option>
                        <option value="BOSNIA AND HERZEGOVINA">
                          BOSNIA AND HERZEGOVINA
                        </option>
                        <option value="BOTSWANA">
                          BOTSWANA
                        </option>
                        <option value="BOUVET ISLAND">
                          BOUVET ISLAND
                        </option>
                        <option value="BRAZIL">
                          BRAZIL
                        </option>
                        <option value=
                        "BRITISH ANTARCTIC TERRITORY">
                          BRITISH ANTARCTIC TERRITORY
                        </option>
                        <option value=
                        "BRITISH INDIAN OCEAN TERRITORY">
                          BRITISH INDIAN OCEAN TERRITORY
                        </option>
                        <option value=
                        "BRITISH SOVEREIGN BASE AREAS">
                          BRITISH SOVEREIGN BASE AREAS
                        </option>
                        <option value="BRITISH VIRGIN ISLANDS">
                          BRITISH VIRGIN ISLANDS
                        </option>
                        <option value="BRUNEI">
                          BRUNEI
                        </option>
                        <option value="BULGARIA">
                          BULGARIA
                        </option>
                        <option value="BURKINA FASO">
                          BURKINA FASO
                        </option>
                        <option value=
                        "BURMA (REPUBLIC OF THE UNION OF MYANMAR)">
                          BURMA (REPUBLIC OF THE UNION OF MYANMAR)
                        </option>
                        <option value="BURUNDI">
                          BURUNDI
                        </option>
                        <option value="CAMBODIA">
                          CAMBODIA
                        </option>
                        <option value="CAMEROON">
                          CAMEROON
                        </option>
                        <option value="CANADA">
                          CANADA
                        </option>
                        <option value="CAPE VERDE">
                          CAPE VERDE
                        </option>
                        <option value="CARIBBEAN NETHERLANDS">
                          CARIBBEAN NETHERLANDS
                        </option>
                        <option value="CAYMAN ISLANDS">
                          CAYMAN ISLANDS
                        </option>
                        <option value="CENTRAL AFRICAN REPUBLIC">
                          CENTRAL AFRICAN REPUBLIC
                        </option>
                        <option value="CHAD">
                          CHAD
                        </option>
                        <option value="CHILE">
                          CHILE
                        </option>
                        <option value="CHINA">
                          CHINA
                        </option>
                        <option value="CHRISTMAS ISLAND">
                          CHRISTMAS ISLAND
                        </option>
                        <option value="CLIPPERTON ISLAND">
                          CLIPPERTON ISLAND
                        </option>
                        <option value="COCOS (KEELING) ISLANDS">
                          COCOS (KEELING) ISLANDS
                        </option>
                        <option value="COLOMBIA">
                          COLOMBIA
                        </option>
                        <option value="COMOROS">
                          COMOROS
                        </option>
                        <option value="CONGO (REPUBLIC OF)">
                          CONGO (REPUBLIC OF)
                        </option>
                        <option value="COOK ISLANDS">
                          COOK ISLANDS
                        </option>
                        <option value="CORAL SEA ISLANDS">
                          CORAL SEA ISLANDS
                        </option>
                        <option value="COSTA RICA">
                          COSTA RICA
                        </option>
                        <option value=
                        "COTE D'IVOIRE (IVORY COAST)">
                          COTE D'IVOIRE (IVORY COAST)
                        </option>
                        <option value="CROATIA">
                          CROATIA
                        </option>
                        <option value="CUBA">
                          CUBA
                        </option>
                        <option value="CURACAO">
                          CURACAO
                        </option>
                        <option value="CYPRUS">
                          CYPRUS
                        </option>
                        <option value="CZECH REPUBLIC">
                          CZECH REPUBLIC
                        </option>
                        <option value=
                        "DEMOCRATIC REPUBLIC OF THE CONGO">
                          DEMOCRATIC REPUBLIC OF THE CONGO
                        </option>
                        <option value="DENMARK">
                          DENMARK
                        </option>
                        <option value="DJIBOUTI">
                          DJIBOUTI
                        </option>
                        <option value="DOMINICA">
                          DOMINICA
                        </option>
                        <option value="DOMINICAN REPUBLIC">
                          DOMINICAN REPUBLIC
                        </option>
                        <option value="ECUADOR">
                          ECUADOR
                        </option>
                        <option value="EGYPT">
                          EGYPT
                        </option>
                        <option value="EL SALVADOR">
                          EL SALVADOR
                        </option>
                        <option value="EQUATORIAL GUINEA">
                          EQUATORIAL GUINEA
                        </option>
                        <option value="ERITREA">
                          ERITREA
                        </option>
                        <option value="ESTONIA">
                          ESTONIA
                        </option>
                        <option value="ETHIOPIA">
                          ETHIOPIA
                        </option>
                        <option value="FALKLAND ISLANDS">
                          FALKLAND ISLANDS
                        </option>
                        <option value="FAROE ISLANDS">
                          FAROE ISLANDS
                        </option>
                        <option value="FIJI">
                          FIJI
                        </option>
                        <option value="FINLAND">
                          FINLAND
                        </option>
                        <option value="FRANCE">
                          FRANCE
                        </option>
                        <option value="FRENCH GUIANA">
                          FRENCH GUIANA
                        </option>
                        <option value="FRENCH POLYNESIA">
                          FRENCH POLYNESIA
                        </option>
                        <option value=
                        "FRENCH SOUTHERN AND ANTARCTIC LANDS">
                          FRENCH SOUTHERN AND ANTARCTIC LANDS
                        </option>
                        <option value=
                        "FRENCH SOUTHERN TERRITORIES">
                          FRENCH SOUTHERN TERRITORIES
                        </option>
                        <option value="GABON">
                          GABON
                        </option>
                        <option value="GAMBIA">
                          GAMBIA
                        </option>
                        <option value="GEORGIA">
                          GEORGIA
                        </option>
                        <option value="GERMANY">
                          GERMANY
                        </option>
                        <option value="GHANA">
                          GHANA
                        </option>
                        <option value="GIBRALTAR">
                          GIBRALTAR
                        </option>
                        <option value="GREECE">
                          GREECE
                        </option>
                        <option value="GREENLAND">
                          GREENLAND
                        </option>
                        <option value="GRENADA">
                          GRENADA
                        </option>
                        <option value="GUADELOUPE">
                          GUADELOUPE
                        </option>
                        <option value="GUAM">
                          GUAM
                        </option>
                        <option value="GUATEMALA">
                          GUATEMALA
                        </option>
                        <option value="GUERNSEY">
                          GUERNSEY
                        </option>
                        <option value="GUINEA">
                          GUINEA
                        </option>
                        <option value="GUINEA-BISSAU">
                          GUINEA-BISSAU
                        </option>
                        <option value="GUYANA">
                          GUYANA
                        </option>
                        <option value="HAITI">
                          HAITI
                        </option>
                        <option value="HEARD AND MCDONALD ISLANDS">
                          HEARD AND MCDONALD ISLANDS
                        </option>
                        <option value="HONDURAS">
                          HONDURAS
                        </option>
                        <option value="HONG KONG">
                          HONG KONG
                        </option>
                        <option value="HOWLAND ISLAND">
                          HOWLAND ISLAND
                        </option>
                        <option value="HUNGARY">
                          HUNGARY
                        </option>
                        <option value="ICELAND">
                          ICELAND
                        </option>
                        <option value="INDIA">
                          INDIA
                        </option>
                        <option value="INDONESIA">
                          INDONESIA
                        </option>
                        <option value="IRAN">
                          IRAN
                        </option>
                        <option value="IRAQ">
                          IRAQ
                        </option>
                        <option value="IRELAND">
                          IRELAND
                        </option>
                        <option value="ISLE OF MAN">
                          ISLE OF MAN
                        </option>
                        <option value="ISRAEL">
                          ISRAEL
                        </option>
                        <option value="ITALY">
                          ITALY
                        </option>
                        <option value="JAMAICA">
                          JAMAICA
                        </option>
                        <option value="JAPAN">
                          JAPAN
                        </option>
                        <option value="JARVIS ISLAND">
                          JARVIS ISLAND
                        </option>
                        <option value="JERSEY">
                          JERSEY
                        </option>
                        <option value="JOHNSTON ATOLL">
                          JOHNSTON ATOLL
                        </option>
                        <option value="JORDAN">
                          JORDAN
                        </option>
                        <option value="KAZAKHSTAN">
                          KAZAKHSTAN
                        </option>
                        <option value="KENYA">
                          KENYA
                        </option>
                        <option value="KINGMAN REEF">
                          KINGMAN REEF
                        </option>
                        <option value="KIRIBATI">
                          KIRIBATI
                        </option>
                        <option value="KOSOVO">
                          KOSOVO
                        </option>
                        <option value="KUWAIT">
                          KUWAIT
                        </option>
                        <option value="KYRGYZSTAN">
                          KYRGYZSTAN
                        </option>
                        <option value="LAOS">
                          LAOS
                        </option>
                        <option value="LATVIA">
                          LATVIA
                        </option>
                        <option value="LEBANON">
                          LEBANON
                        </option>
                        <option value="LESOTHO">
                          LESOTHO
                        </option>
                        <option value="LIBERIA">
                          LIBERIA
                        </option>
                        <option value="LIBYA">
                          LIBYA
                        </option>
                        <option value="LIECHTENSTEIN">
                          LIECHTENSTEIN
                        </option>
                        <option value="LITHUANIA">
                          LITHUANIA
                        </option>
                        <option value="LUXEMBOURG">
                          LUXEMBOURG
                        </option>
                        <option value="MACAU">
                          MACAU
                        </option>
                        <option value="MACEDONIA">
                          MACEDONIA
                        </option>
                        <option value="MADAGASCAR">
                          MADAGASCAR
                        </option>
                        <option value="MALAWI">
                          MALAWI
                        </option>
                        <option value="MALAYSIA">
                          MALAYSIA
                        </option>
                        <option value="MALDIVES">
                          MALDIVES
                        </option>
                        <option value="MALI">
                          MALI
                        </option>
                        <option value="MALTA">
                          MALTA
                        </option>
                        <option value="MARSHALL ISLANDS">
                          MARSHALL ISLANDS
                        </option>
                        <option value="MARTINIQUE">
                          MARTINIQUE
                        </option>
                        <option value="MAURITANIA">
                          MAURITANIA
                        </option>
                        <option value="MAURITIUS">
                          MAURITIUS
                        </option>
                        <option value="MAYOTTE">
                          MAYOTTE
                        </option>
                        <option value="MEXICO">
                          MEXICO
                        </option>
                        <option value="MICRONESIA">
                          MICRONESIA
                        </option>
                        <option value="MIDWAY ISLANDS">
                          MIDWAY ISLANDS
                        </option>
                        <option value="MOLDOVA">
                          MOLDOVA
                        </option>
                        <option value="MONACO">
                          MONACO
                        </option>
                        <option value="MONGOLIA">
                          MONGOLIA
                        </option>
                        <option value="MONTENEGRO">
                          MONTENEGRO
                        </option>
                        <option value="MONTSERRAT">
                          MONTSERRAT
                        </option>
                        <option value="MOROCCO">
                          MOROCCO
                        </option>
                        <option value="MOZAMBIQUE">
                          MOZAMBIQUE
                        </option>
                        <option value="NAGORNO-KARABAKH">
                          NAGORNO-KARABAKH
                        </option>
                        <option value="NAMIBIA">
                          NAMIBIA
                        </option>
                        <option value="NAURU">
                          NAURU
                        </option>
                        <option value="NAVASSA ISLAND">
                          NAVASSA ISLAND
                        </option>
                        <option value="NEPAL">
                          NEPAL
                        </option>
                        <option value="NETHERLANDS">
                          NETHERLANDS
                        </option>
                        <option value="NEW CALEDONIA">
                          NEW CALEDONIA
                        </option>
                        <option value="NEW ZEALAND">
                          NEW ZEALAND
                        </option>
                        <option value="NICARAGUA">
                          NICARAGUA
                        </option>
                        <option value="NIGER">
                          NIGER
                        </option>
                        <option value="NIGERIA">
                          NIGERIA
                        </option>
                        <option value="NIUE">
                          NIUE
                        </option>
                        <option value="NORFOLK ISLAND">
                          NORFOLK ISLAND
                        </option>
                        <option value="NORTH KOREA">
                          NORTH KOREA
                        </option>
                        <option value="NORTHERN CYPRUS">
                          NORTHERN CYPRUS
                        </option>
                        <option value="NORTHERN MARIANA ISLANDS">
                          NORTHERN MARIANA ISLANDS
                        </option>
                        <option value="NORWAY">
                          NORWAY
                        </option>
                        <option value="OMAN">
                          OMAN
                        </option>
                        <option value="PAKISTAN">
                          PAKISTAN
                        </option>
                        <option value="PALAU">
                          PALAU
                        </option>
                        <option value="PALESTINE">
                          PALESTINE
                        </option>
                        <option value="PALMYRA ATOLL">
                          PALMYRA ATOLL
                        </option>
                        <option value="PANAMA">
                          PANAMA
                        </option>
                        <option value="PAPUA NEW GUINEA">
                          PAPUA NEW GUINEA
                        </option>
                        <option value="PARAGUAY">
                          PARAGUAY
                        </option>
                        <option value="PERU">
                          PERU
                        </option>
                        <option value="PETER I ISLAND">
                          PETER I ISLAND
                        </option>
                        <option value="PHILIPPINES">
                          PHILIPPINES
                        </option>
                        <option value="PITCAIRN">
                          PITCAIRN
                        </option>
                        <option value="PITCAIRN ISLANDS">
                          PITCAIRN ISLANDS
                        </option>
                        <option value="POLAND">
                          POLAND
                        </option>
                        <option value="PORTUGAL">
                          PORTUGAL
                        </option>
                        <option value=
                        "PRIDNESTROVIE (TRANSNISTRIA)">
                          PRIDNESTROVIE (TRANSNISTRIA)
                        </option>
                        <option value="PUERTO RICO">
                          PUERTO RICO
                        </option>
                        <option value="QATAR">
                          QATAR
                        </option>
                        <option value="QUEEN MAUD LAND">
                          QUEEN MAUD LAND
                        </option>
                        <option value="REUNION">
                          REUNION
                        </option>
                        <option value="ROMANIA">
                          ROMANIA
                        </option>
                        <option value="ROSS DEPENDENCY">
                          ROSS DEPENDENCY
                        </option>
                        <option value="RUSSIAN FEDERATION">
                          RUSSIAN FEDERATION
                        </option>
                        <option value="RWANDA">
                          RWANDA
                        </option>
                        <option value="SAINT BARTHELEMY">
                          SAINT BARTHELEMY
                        </option>
                        <option value="SAINT HELENA">
                          SAINT HELENA
                        </option>
                        <option value="SAINT KITTS AND NEVIS">
                          SAINT KITTS AND NEVIS
                        </option>
                        <option value="SAINT LUCIA">
                          SAINT LUCIA
                        </option>
                        <option value="SAINT MARTIN (FRANCE)">
                          SAINT MARTIN (FRANCE)
                        </option>
                        <option value="SAINT MARTIN (NETHERLANDS)">
                          SAINT MARTIN (NETHERLANDS)
                        </option>
                        <option value="SAINT PIERRE AND MIQUELON">
                          SAINT PIERRE AND MIQUELON
                        </option>
                        <option value=
                        "SAINT VINCENT AND GRENADINES">
                          SAINT VINCENT AND GRENADINES
                        </option>
                        <option value="SAMOA">
                          SAMOA
                        </option>
                        <option value="SAN MARINO">
                          SAN MARINO
                        </option>
                        <option value="SAO TOME AND PRINCIPE">
                          SAO TOME AND PRINCIPE
                        </option>
                        <option value="SAUDI ARABIA">
                          SAUDI ARABIA
                        </option>
                        <option value="SENEGAL">
                          SENEGAL
                        </option>
                        <option value="SERBIA">
                          SERBIA
                        </option>
                        <option value="SEYCHELLES">
                          SEYCHELLES
                        </option>
                        <option value="SIERRA LEONE">
                          SIERRA LEONE
                        </option>
                        <option value="SINGAPORE">
                          SINGAPORE
                        </option>
                        <option value="SLOVAKIA">
                          SLOVAKIA
                        </option>
                        <option value="SLOVENIA">
                          SLOVENIA
                        </option>
                        <option value="SOLOMON ISLANDS">
                          SOLOMON ISLANDS
                        </option>
                        <option value="SOMALIA">
                          SOMALIA
                        </option>
                        <option value="SOMALILAND">
                          SOMALILAND
                        </option>
                        <option value="SOUTH AFRICA">
                          SOUTH AFRICA
                        </option>
                        <option value=
                        "SOUTH GEORGIA &amp; SOUTH SANDWICH ISLANDS">
                        SOUTH GEORGIA &amp; SOUTH SANDWICH ISLANDS
                        </option>
                        <option value=
                        "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">
                        SOUTH GEORGIA AND THE SOUTH SANDWICH
                        ISLANDS
                        </option>
                        <option value="SOUTH KOREA">
                          SOUTH KOREA
                        </option>
                        <option value="SOUTH OSSETIA">
                          SOUTH OSSETIA
                        </option>
                        <option value="SOUTH SUDAN">
                          SOUTH SUDAN
                        </option>
                        <option value="SPAIN">
                          SPAIN
                        </option>
                        <option value="SRI LANKA">
                          SRI LANKA
                        </option>
                        <option value="SUDAN">
                          SUDAN
                        </option>
                        <option value="SURINAME">
                          SURINAME
                        </option>
                        <option value=
                        "SVALBARD AND JAN MAYEN ISLANDS">
                          SVALBARD AND JAN MAYEN ISLANDS
                        </option>
                        <option value="SWAZILAND">
                          SWAZILAND
                        </option>
                        <option value="SWEDEN">
                          SWEDEN
                        </option>
                        <option value="SWITZERLAND">
                          SWITZERLAND
                        </option>
                        <option value="SYRIA">
                          SYRIA
                        </option>
                        <option value="TAIWAN">
                          TAIWAN
                        </option>
                        <option value="TAJIKISTAN">
                          TAJIKISTAN
                        </option>
                        <option value="TANZANIA">
                          TANZANIA
                        </option>
                        <option value="THAILAND">
                          THAILAND
                        </option>
                        <option value="TIMOR-LESTE">
                          TIMOR-LESTE
                        </option>
                        <option value="TOGO">
                          TOGO
                        </option>
                        <option value="TOKELAU">
                          TOKELAU
                        </option>
                        <option value="TONGA">
                          TONGA
                        </option>
                        <option value="TRINIDAD AND TOBAGO">
                          TRINIDAD AND TOBAGO
                        </option>
                        <option value="TRISTAN DA CUNHA">
                          TRISTAN DA CUNHA
                        </option>
                        <option value="TUNISIA">
                          TUNISIA
                        </option>
                        <option value="TURKEY">
                          TURKEY
                        </option>
                        <option value="TURKMENISTAN">
                          TURKMENISTAN
                        </option>
                        <option value="TURKS AND CAICOS ISLANDS">
                          TURKS AND CAICOS ISLANDS
                        </option>
                        <option value="TUVALU">
                          TUVALU
                        </option>
                        <option value="UGANDA">
                          UGANDA
                        </option>
                        <option value="UKRAINE">
                          UKRAINE
                        </option>
                        <option value="UNITED ARAB EMIRATES">
                          UNITED ARAB EMIRATES
                        </option>
                        <option value="UNITED KINGDOM">
                          UNITED KINGDOM
                        </option>
                        <option value=
                        "UNITED STATES MINOR OUTLYING ISLANDS">
                          UNITED STATES MINOR OUTLYING ISLANDS
                        </option>
                        <option value="UNITED STATES OF AMERICA">
                          UNITED STATES OF AMERICA
                        </option>
                        <option value=
                        "UNITED STATES VIRGIN ISLANDS">
                          UNITED STATES VIRGIN ISLANDS
                        </option>
                        <option value="URUGUAY">
                          URUGUAY
                        </option>
                        <option value="UZBEKISTAN">
                          UZBEKISTAN
                        </option>
                        <option value="VANUATU">
                          VANUATU
                        </option>
                        <option value="VATICAN">
                          VATICAN
                        </option>
                        <option value="VENEZUELA">
                          VENEZUELA
                        </option>
                        <option value="VIETNAM">
                          VIETNAM
                        </option>
                        <option value="WAKE ISLAND">
                          WAKE ISLAND
                        </option>
                        <option value="WALLIS AND FUTUNA ISLANDS">
                          WALLIS AND FUTUNA ISLANDS
                        </option>
                        <option value="WESTERN SAHARAN">
                          WESTERN SAHARAN
                        </option>
                        <option value="YEMEN">
                          YEMEN
                        </option>
                        <option value="ZAMBIA">
                          ZAMBIA
                        </option>
                        <option value="ZIMBABWE">
                          ZIMBABWE
                        </option>
                        <option value="UNKNOWN">
                          UNKNOWN
                        </option>
                      </select>
                      <div id="id-type-box">
                        <label>Select Identification type</label>
                        <h6 class="announcement">
                          Driver’s license is NOT an acceptable
                          document for users outside the U.S. and
                          Canada.
                        </h6><select id="idType" class=
                        "form-control">
						  <option value="NRIC" selected="selected">
                            National Registration Identity Card
                          </option>
                          <option value="PASSPORT">
                            Passport
                          </option>
                          <option value="DRIVING LICENSE">
                            Driver's License (US and CANADA
                            residents only)
                          </option>
                          <option value="ID">
                            ID
                          </option>
                        </select>
                      </div>
                      <div id="id-input-box">
                        <label id="id-label">ID #</label>
                        <input class="form-control acct-input" id=
                        "id" placeholder="ID Number" maxlength=
                        "100" minlength="2" required="" />
                      </div>
                      <div id="file-upload">
                        <h5 class="bold">
                          Images must be less than 10MB
                        </h5>
                        <div id="file-upload-box">
                          <label id="doc-label">Copy of
                          ID</label> <input id="doc-file"
                          class="file acct-input form-control"
                          accept=".jpg,.jpeg,.png" name="file1"
                          type="file" data-max-size="10000" />
                          <label><span id="selfie-label">Selfie
                          with ID.</span> Name and picture
                          must be clear.<a id="example-hyperlink"
                          data-toggle="modal" href="#exampleModal"
                          data-target="#exampleModal" class=
                          "yellow-link">example</a></label>
                          <input id="selfie-file" class=
                          "file acct-input form-control" accept=
                          ".jpg,.jpeg,.png" name="file2" type=
                          "file" data-max-size="10000" />
                        </div>
                      </div>
                    </div>
                    <p id="acct-form-msg"></p>
                    <div class="submit-page-btns">
                      <button class="btn back-btn" type="button"
                      onclick="backStep2()">Back</button>
                      <button class="btn next-btn" type="button"
                      onclick="nextStep2()">Next</button>
                    </div>
                  </div>
                  <div id="submit-page">
                    <div id="submit-page-review"></div>
                    <div id="preview-uploads">
                      <div class="col-xs-6 preview-box">
                        <img id="doc-preview" />
                      </div>
                      <div class="col-xs-6 preview-box">
                        <img id="selfie-preview" />
                      </div>
                    </div>
                    <div id="submit-page-info">
                      <p>
                        Before submitting, please make sure that
                        all information you have provided is
                        accurate.
                      </p>
                      <p>
                        The KYC process will take some time. After
                        submitting, you will receive an email
                        confirming your registration.
                      </p>
                      <p>
                        A few days later, you will receive an
                        additional email stating whether you were
                        approved or rejected.
                      </p>
                      <p>
                        Only approved people will be allowed
                        to participate in the sale.
                      </p>
                    </div>
                    <div class="form-group">
                      <label><input id="info-checkbox" class=
                      "checkbox" type="checkbox" /> The information
                      I have provided is correct.</label>
                      <label><input id="terms-checkbox" class=
                      "checkbox" type="checkbox" /> I have read and
                      understood the Nucleus Token sale <a target=
                      "_blank" href="#" rel="noopener" class=
                      "yellow-link">Terms of Service</a> and the
                      <a target="_blank" href="#" rel="noopener"
                      class="yellow-link">Privacy Policy</a>, and
                      hereby agree to them.</label>
                    </div>
                    <div id="g-recaptcha3" class="g-recaptcha"
                    data-callback="recaptchaResponse3"></div>
                    <div class="submit-page-btns">
                      <button class="btn back-btn" type="button"
                      onclick="backStep3()">Back</button>
                      <button id="submit-btn" class=
                      "btn next-btn submit-btn" type="submit"
                      disabled="disabled">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="overlay">
                <div id="loader"></div>
              </div>
              <p id="errMsg"></p>
            </div>
            <div id="success-page">
              <div>
                <h2>
                  Success
                </h2>
                <h5>
                  You’ve completed the registration process. You
                  will be able to check your status at <a target=
                  "_blank" href="/status" rel="noopener" class=
                  "yellow-link">https://nucleus.vision/status</a>
                  to see if you’re approved to participate in the
                  Nucleus Token Crowdsale. Please check
                  <a target="_blank" href=
                  "https://nucleus.vision" rel=
                  "noopener" class=
                  "yellow-link">https://nucleus.vision</a>
                  for further updates.
                </h5>
              </div>
            </div>
            <div id="expired-page">
                <div id="countdownExample1" class="col-xs-12">
                  <p>
                    Session expired. Please start over.
                  </p>
                  <div class="values"></div>
                </div>
                <div>
                  <h2 id="expired-error"></h2><button id=
                  "refresh-btn" class="btn">Start Over</button>
                </div>
            </div>
          </div>
        </div>
      </div>
      <p align="center" class="mrt60">
        <a href="#" class="yellow-link">Privacy Policy</a><br />
        © 2014 Nucleus Vision (formerly Bell Boi, Inc.)
      </p>
    </div><script src="js/plugins/jquery-3.2.1.min.js" type=
    "text/javascript">
</script><script src="js/plugins/bootstrap.min.js" type=
"text/javascript">
</script><script src="js/plugins/jquery-ui.min.js" type=
"text/javascript">
</script><script src="js/plugins/spin.min.js" type=
"text/javascript">
</script><script src="js/plugins/easytimer.min.js" type=
"text/javascript">
</script><script src="js/plugins/register.min.js" type=
"text/javascript">
</script>
  </body>
</html>