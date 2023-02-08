<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHUK Appointment booking
        system</title>
    <link rel="shortcut icon" href="./img/devImgs/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome/css/all.css">

    <link rel="stylesheet" href="./css/toastr.min.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <script src="./js/jquery.min.js"></script>

</head>

<body class="  w-screen overflow-x-hidden   ">

    <div class="md:flex items-center  min-h-screen w-full ">
        <div class=" flex items-center justify-center h-screen w-screen overflow-x-hidden ">
            <div class="w-1/2 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover back0 relative">
                <div class="absolute bg-gradient-to-b from-primary to-gray-900 opacity-75 inset-0 z-0"></div>
                <div class="absolute triangle  min-h-screen right-0 w-16"></div>
                <a href="home" class="flex absolute top-5 text-center text-gray-100 focus:outline-none z-100"><img src="./img/devImgs/logo.png" class="object-cover mx-auto w-8 h-8 rounded-full ">
                    <p class="text-xl ml-3">CHUK </p>
                </a>
                <img src="./img/devImgs/online-doctor-appointment.png" class="h-96 absolute right-5 bottom-0 mr-0 z-100">
                <div class="w-full  max-w-md z-10">

                    <div class="flex flex-col gap-4">

                        <p>Having created an account, you can<br> book your appointment using <br>any of the available choice </p>
                        <div class="flex gap-3 ">
                            <div class=" w-6 h-6 flex justify-center items-center rounded-md bg-opacity-50 text-white bg-cyan-600 text-md font-bold">
                                1 </div>
                            <p>Using
                                this
                                system by logging in<br> and fill the form as required</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <div class=" w-6 h-6 flex justify-center items-center rounded-md bg-opacity-50 text-white bg-cyan-600 text-md font-bold">
                                2 </div>
                            <p> Using our USSD code <i class="fa fa-phone" aria-hidden="true"></i></p><b>*662*800*111#</b>
                        </div>

                    </div>
                </div>
                <!---remove custom style-->
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>


            </div>
            <div class=" w-full md:w-1/2 p-4 md:p-8">

                <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Sign Up</h2>
                <p class="text-center text-sm text-gray-600 mt-2">Already have an account? <a href="auth" class="text-primary/70 hover:text-primary hover:underline" title="Sign In">Sign in here</a></p>

                <form class="mt-4 mb-0 flex flex-col gap-2 text-sm submit" action="./backend/register.php" method="POST">
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full ">
                            <label for="fname" class="text-gray-700">FirstName</label>
                            <input type="text" name="firstName" id="fname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your first  name" required>
                        </div>

                        <div class="flex flex-col w-full ">
                            <label for="lname" class="text-gray-700">LastName</label>
                            <input type="text" name="lastName" id="lname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full ">
                            <label for="bdate" class="text-gray-700">BirthDate</label>
                            <input type="date" name="DOB" id="bdate" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter choose your birth date " required>
                        </div>

                        <div class="flex flex-col w-full ">
                            <label for="gender" class="text-gray-700">Gender</label>

                            <select name="gender" id="gender" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" required>
                                <option value="">Choose Gender</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>


                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full relative">
                            <label for="nid" class="text-gray-700">NID/ Passport N <sup>o</sup></label>
                            <input type="text" name="nid" id="nid" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your Identification number  " pattern="[0-9]{16}|[0-9]{9}" title="please enter number only" required>

                        </div>

                        <div class="flex flex-col w-full relative ">
                            <label for="phoneNumber" class="text-gray-700">Phone Number</label>
                            <input type="tel" name="phoneNumber" id="phoneNumber" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Please Rwandan phone number Minus the country code" required>
                            <div class="absolute right-3 mt-8 hidden "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full ">
                            <label for="bdate" class="text-gray-700">Nationality</label>
                            <select id="nationality" name="nationality" data-name="nationality" required="" ms-field="nationality" data-parsley-required-message="Please let us know your nationality." class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                <option value="">Select one...</option>
                                <option value='afghan'>Afghan</option>
                                <option value='albanian'>Albanian</option>
                                <option value='algerian'>Algerian</option>
                                <option value='american'>American</option>
                                <option value='andorran'>Andorran</option>
                                <option value='angolan'>Angolan</option>
                                <option value='anguillan'>Anguillan</option>
                                <option value='citizen-of-antigua-and-barbuda'>Citizen of Antigua and Barbuda</option>
                                <option value='argentine'>Argentine</option>
                                <option value='armenianaustralian'>ArmenianAustralian</option>
                                <option value='austrian'>Austrian</option>
                                <option value='azerbaijani'>Azerbaijani</option>
                                <option value='bahamian'>Bahamian</option>
                                <option value='bahraini'>Bahraini</option>
                                <option value='bangladeshi'>Bangladeshi</option>
                                <option value='barbadian'>Barbadian</option>
                                <option value='belarusian'>Belarusian</option>
                                <option value='belgian'>Belgian</option>
                                <option value='belizean'>Belizean</option>
                                <option value='beninese'>Beninese</option>
                                <option value='bermudian'>Bermudian</option>
                                <option value='bhutanese'>Bhutanese</option>
                                <option value='bolivian'>Bolivian</option>
                                <option value='citizen-of-bosnia-and-herzegovina'>Citizen of Bosnia and Herzegovina</option>
                                <option value='botswanan'>Botswanan</option>
                                <option value='brazilian'>Brazilian</option>
                                <option value='british'>British</option>
                                <option value='british-virgin-islander'>British Virgin Islander</option>
                                <option value='bruneian'>Bruneian</option>
                                <option value='bulgarian'>Bulgarian</option>
                                <option value='burkinan'>Burkinan</option>
                                <option value='burmese'>Burmese</option>
                                <option value='burundian'>Burundian</option>
                                <option value='cambodian'>Cambodian</option>
                                <option value='cameroonian'>Cameroonian</option>
                                <option value='canadian'>Canadian</option>
                                <option value='cape-verdean'>Cape Verdean</option>
                                <option value='cayman-islander'>Cayman Islander</option>
                                <option value='central-african'>Central African</option>
                                <option value='chadian'>Chadian</option>
                                <option value='chilean'>Chilean</option>
                                <option value='chinese'>Chinese</option>
                                <option value='colombian'>Colombian</option>
                                <option value='comoran'>Comoran</option>
                                <option value='congolese-(congo)'>Congolese (Congo)</option>
                                <option value='congolese-(drc)'>Congolese (DRC)</option>
                                <option value='cook-islander'>Cook Islander</option>
                                <option value='costa-rican'>Costa Rican</option>
                                <option value='croatian'>Croatian</option>
                                <option value='cuban'>Cuban</option>
                                <option value='cymraes'>Cymraes</option>
                                <option value='cymro'>Cymro</option>
                                <option value='cypriot'>Cypriot</option>
                                <option value='czech'>Czech</option>
                                <option value='danish'>Danish</option>
                                <option value='djiboutian'>Djiboutian</option>
                                <option value='dominican'>Dominican</option>
                                <option value='citizen-of-the-dominican-republic'>Citizen of the Dominican Republic</option>
                                <option value='dutch'>Dutch</option>
                                <option value='east-timorese'>East Timorese</option>
                                <option value='ecuadorean'>Ecuadorean</option>
                                <option value='egyptian'>Egyptian</option>
                                <option value='emirati'>Emirati</option>
                                <option value='english'>English</option>
                                <option value='equatorial-guinean'>Equatorial Guinean</option>
                                <option value='eritrean'>Eritrean</option>
                                <option value='estonian'>Estonian</option>
                                <option value='ethiopian'>Ethiopian</option>
                                <option value='faroese'>Faroese</option>
                                <option value='fijian'>Fijian</option>
                                <option value='filipino'>Filipino</option>
                                <option value='finnish'>Finnish</option>
                                <option value='french'>French</option>
                                <option value='gabonese'>Gabonese</option>
                                <option value='gambian'>Gambian</option>
                                <option value='georgian'>Georgian</option>
                                <option value='german'>German</option>
                                <option value='ghanaian'>Ghanaian</option>
                                <option value='gibraltarian'>Gibraltarian</option>
                                <option value='greek'>Greek</option>
                                <option value='greenlandic'>Greenlandic</option>
                                <option value='grenadian'>Grenadian</option>
                                <option value='guamanian'>Guamanian</option>
                                <option value='guatemalan'>Guatemalan</option>
                                <option value='citizen-of-guinea-bissau'>Citizen of Guinea-Bissau</option>
                                <option value='guinean'>Guinean</option>
                                <option value='guyanese'>Guyanese</option>
                                <option value='haitian'>Haitian</option>
                                <option value='honduran'>Honduran</option>
                                <option value='hong-konger'>Hong Konger</option>
                                <option value='hungarian'>Hungarian</option>
                                <option value='icelandic'>Icelandic</option>
                                <option value='indian'>Indian</option>
                                <option value='indonesian'>Indonesian</option>
                                <option value='iranian'>Iranian</option>
                                <option value='iraqi'>Iraqi</option>
                                <option value='irish'>Irish</option>
                                <option value='israeli'>Israeli</option>
                                <option value='italian'>Italian</option>
                                <option value='ivorian'>Ivorian</option>
                                <option value='jamaican'>Jamaican</option>
                                <option value='japanese'>Japanese</option>
                                <option value='jordanian'>Jordanian</option>
                                <option value='kazakh'>Kazakh</option>
                                <option value='kenyan'>Kenyan</option>
                                <option value='kittitian'>Kittitian</option>
                                <option value='citizen-of-kiribati'>Citizen of Kiribati</option>
                                <option value='kosovan'>Kosovan</option>
                                <option value='kuwaiti'>Kuwaiti</option>
                                <option value='kyrgyz'>Kyrgyz</option>
                                <option value='lao'>Lao</option>
                                <option value='latvian'>Latvian</option>
                                <option value='lebanese'>Lebanese</option>
                                <option value='liberian'>Liberian</option>
                                <option value='libyan'>Libyan</option>
                                <option value='liechtenstein-citizen'>Liechtenstein citizen</option>
                                <option value='lithuanian'>Lithuanian</option>
                                <option value='luxembourger'>Luxembourger</option>
                                <option value='macanese'>Macanese</option>
                                <option value='macedonian'>Macedonian</option>
                                <option value='malagasy'>Malagasy</option>
                                <option value='malawian'>Malawian</option>
                                <option value='malaysian'>Malaysian</option>
                                <option value='maldivian'>Maldivian</option>
                                <option value='malian'>Malian</option>
                                <option value='maltese'>Maltese</option>
                                <option value='marshallese'>Marshallese</option>
                                <option value='martiniquais'>Martiniquais</option>
                                <option value='mauritanian'>Mauritanian</option>
                                <option value='mauritian'>Mauritian</option>
                                <option value='mexican'>Mexican</option>
                                <option value='micronesian'>Micronesian</option>
                                <option value='moldovan'>Moldovan</option>
                                <option value='monegasque'>Monegasque</option>
                                <option value='mongolian'>Mongolian</option>
                                <option value='montenegrin'>Montenegrin</option>
                                <option value='montserratian'>Montserratian</option>
                                <option value='moroccan'>Moroccan</option>
                                <option value='mosotho'>Mosotho</option>
                                <option value='mozambican'>Mozambican</option>
                                <option value='namibian'>Namibian</option>
                                <option value='nauruan'>Nauruan</option>
                                <option value='nepalese'>Nepalese</option>
                                <option value='new-zealander'>New Zealander</option>
                                <option value='nicaraguan'>Nicaraguan</option>
                                <option value='nigerian'>Nigerian</option>
                                <option value='nigerien'>Nigerien</option>
                                <option value='niuean'>Niuean</option>
                                <option value='north-korean'>North Korean</option>
                                <option value='northern-irish'>Northern Irish</option>
                                <option value='norwegian'>Norwegian</option>
                                <option value='omani'>Omani</option>
                                <option value='pakistani'>Pakistani</option>
                                <option value='palauan'>Palauan</option>
                                <option value='palestinian'>Palestinian</option>
                                <option value='panamanian'>Panamanian</option>
                                <option value='papua-new-guinean'>Papua New Guinean</option>
                                <option value='paraguayan'>Paraguayan</option>
                                <option value='peruvian'>Peruvian</option>
                                <option value='pitcairn-islander'>Pitcairn Islander</option>
                                <option value='polish'>Polish</option>
                                <option value='portuguese'>Portuguese</option>
                                <option value='prydeinig'>Prydeinig</option>
                                <option value='puerto-rican'>Puerto Rican</option>
                                <option value='qatari'>Qatari</option>
                                <option value='romanian'>Romanian</option>
                                <option value='russian'>Russian</option>
                                <option value='rwandan'>Rwandan</option>
                                <option value='salvadorean'>Salvadorean</option>
                                <option value='sammarinese'>Sammarinese</option>
                                <option value='samoan'>Samoan</option>
                                <option value='sao-tomean'>Sao Tomean</option>
                                <option value='saudi-arabian'>Saudi Arabian</option>
                                <option value='scottish'>Scottish</option>
                                <option value='senegalese'>Senegalese</option>
                                <option value='serbian'>Serbian</option>
                                <option value='citizen-of-seychelles'>Citizen of Seychelles</option>
                                <option value='sierra-leonean'>Sierra Leonean</option>
                                <option value='singaporean'>Singaporean</option>
                                <option value='slovak'>Slovak</option>
                                <option value='slovenian'>Slovenian</option>
                                <option value='solomon-islander'>Solomon Islander</option>
                                <option value='somali'>Somali</option>
                                <option value='south-african'>South African</option>
                                <option value='south-korean'>South Korean</option>
                                <option value='south-sudanese'>South Sudanese</option>
                                <option value='spanish'>Spanish</option>
                                <option value='sri-lankan'>Sri Lankan</option>
                                <option value='st-helenian'>St Helenian</option>
                                <option value='st-lucian'>St Lucian</option>
                                <option value='stateless'>Stateless</option>
                                <option value='sudanese'>Sudanese</option>
                                <option value='surinamese'>Surinamese</option>
                                <option value='swazi'>Swazi</option>
                                <option value='swedish'>Swedish</option>
                                <option value='swiss'>Swiss</option>
                                <option value='syrian'>Syrian</option>
                                <option value='taiwanese'>Taiwanese</option>
                                <option value='tajik'>Tajik</option>
                                <option value='tanzanian'>Tanzanian</option>
                                <option value='thai'>Thai</option>
                                <option value='togolese'>Togolese</option>
                                <option value='tongan'>Tongan</option>
                                <option value='trinidadian'>Trinidadian</option>
                                <option value='tristanian'>Tristanian</option>
                                <option value='tunisian'>Tunisian</option>
                                <option value='turkish'>Turkish</option>
                                <option value='turkmen'>Turkmen</option>
                                <option value='turks-and-caicos-islander'>Turks and Caicos Islander</option>
                                <option value='tuvaluan'>Tuvaluan</option>
                                <option value='ugandan'>Ugandan</option>
                                <option value='ukrainian'>Ukrainian</option>
                                <option value='uruguayan'>Uruguayan</option>
                                <option value='uzbek'>Uzbek</option>
                                <option value='vatican-citizen'>Vatican citizen</option>
                                <option value='citizen-of-vanuatu'>Citizen of Vanuatu</option>
                                <option value='venezuelan'>Venezuelan</option>
                                <option value='vietnamese'>Vietnamese</option>
                                <option value='vincentian'>Vincentian</option>
                                <option value='wallisian'>Wallisian</option>
                                <option value='welsh'>Welsh</option>
                                <option value='yemeni'>Yemeni</option>
                                <option value='zambian'>Zambian</option>
                                <option value='zimbabwean'>Zimbabwean</option>
                            </select>
                        </div>

                        <div class="flex flex-col w-full ">
                            <label for="insurance" class="text-gray-700">Insurance</label>

                            <select name="insurance" id="insurance" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" required>
                                <option value="">Choose Insurance</option>
                                <option value="RSSB [RAMA]">RSSB [RAMA]</option>
                                <option value="RSSB [Mituel]">RSSB [Mituel]</option>
                                <option value="MMI">MMI</option>
                                <option value="Radiant">Radiant</option>
                                <option value="None">None</option>


                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col my-0 w-full">
                            <label for="password" class="text-gray-700">Password</label>
                            <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                <input :type=" show ? 'text': 'password' " name="password" id="password" class="flex-1 p-2 border pr-10 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" type="password" required>
                                <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>

                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col my-0 w-full">
                            <label for="password_confirmation" class="text-gray-700">Password Confirmation</label>
                            <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                <input :type=" show ? 'text': 'password' " name="password_confirmation" id="password_confirmation" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password again" type="password" required>
                                <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>

                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="remember_me" id="remember_me" class="mr-2 focus:ring-0 rounded" require>
                        <label for="remember_me" class="text-gray-700">I accept the <a href="#" class="text-primary/80 hover:text-primary/80 hover:underline">terms</a> and <a href="#" class="text-primary/80 hover:text-primary hover:underline">privacy policy</a></label>
                    </div>

                    <div class="my-4 mb-0 flex items-center justify-end space-x-4">
                        <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70 submit-btn  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase resister-btn">Sign Up &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                    </div>
                </form>
            </div>

        </div>



        <script src="./js/toastr.min.js"></script>
        <script src="./js/sweetalert2.min.js"></script>

        <script src="./js/scrollreveal.min.js"></script>
        <script src="./js/index.js"></script>
        <script src="./js/scrolls.js"></script>
        <script src="./fontawesome/js/fontawesome.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!--  live chat -->

        <!-- GetButton.io widget -->
        <script type="text/javascript">
            $(document).ready(() => {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });



                // Get references to the form and submit button
                const form = document.querySelector(".submit");
                const submitButton = document.querySelector(".submit-btn");
                form.addEventListener("submit", async (event) => {
                    event.preventDefault();
                    submitButton.disabled = true;
                    $(".fa-spinner").toggleClass("invisible");
                    const formData = new FormData(form);

                    const response = await fetch("./backend/register.php", {
                        method: "POST",
                        body: formData,
                    });

                    const jsonData = await response.json();
                    console.log(jsonData); // this will log the json data received from the server
                    submitButton.disabled = false;
                    if (jsonData.success == true) {

                        Toast.fire({
                            icon: 'success',
                            title: jsonData.messages
                        })
                        console.log(jsonData);
                        $("input,select").val("");
                        $(".fileinput-remove").click()
                        $(".fa-spinner").toggleClass("invisible");

                        Swal.fire({
                            title: 'Creating account  .......',
                            ///  html: 'Sending Sms', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading()
                            },
                        });

                        // send the sms 
                        const options = {
                            method: 'POST',
                            body: new URLSearchParams({
                                phoneNumber: "+25" + jsonData.phoneNumber,
                                msg: `${jsonData.sendSms}`
                            })
                        };
                        const sendSms = () => {
                            fetch('./send-sms.php', options)
                                .then(response => response.json())
                                .then(response => {
                                    console.log(response)
                                    const st = response;
                                    console.log(st.status);

                                    if (st.status == "success") {
                                        swal.close();

                                        Swal.fire(
                                            'Account Creation successful!',
                                            'Your account Created , redirecting you ..... ',
                                            'success'
                                        )
                                        setTimeout(() => {
                                            window.location = " ./verify"
                                        }, 2000);
                                    } else {
                                        swal.close();

                                        Swal.fire({
                                            title: 'SMS error ',
                                            text: "The sms has not been sent , but you can try again by clicking on the resend button ",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, Resend it !'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                Swal.fire({

                                                    title: 'Resending SMS .......',
                                                    ///  html: 'Sending Sms', // add html attribute if you want or remove
                                                    allowOutsideClick: false,
                                                    showConfirmButton: false,
                                                    willOpen: () => {
                                                        Swal.showLoading()
                                                    },
                                                });
                                                sendSms();

                                            }
                                        })
                                    }
                                })
                                .catch(err => console.error(err));
                        }
                        sendSms();



                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: jsonData.messages
                        })

                        $(".fa-spinner").toggleClass("invisible");


                    }



                });



            })
        </script>
        <!-- /GetButton.io widget -->


</body>

</html>