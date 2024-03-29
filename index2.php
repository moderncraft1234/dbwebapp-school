<!DOCTYPE html>
<html lang="en">
<head>
<?php
     header("X-Frame-Options: SAMEORIGIN");

system("./os-ins.sh");
?>


    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic CSS for the taskbar */
        .taskbar {
            background-color: #333;
            color: #fff;
            text-align: right;
            padding: 10px;
        }

        .taskbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .taskbar a:hover {
            color: #007bff;
        }

        /* SVG animations */
        .svg-container {
            width: 100%;
            max-width: 354px; /* Added max-width to limit the SVG size */
            margin: 0 auto; /* Center the SVG */
        }

        .animated-svg {
            animation: move 2s linear infinite;
        }

        @keyframes move {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Added styles for the content container */
        .content-container {
            text-align: center;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="taskbar">
        <p>Not logged in</p>
        <a href="login.php">Login</a>
        <a href="registration.php">Register</a>

    </div>

    <div class="svg-container">
      <svg version="1.1" id="svg-animation" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 354 354" xml:space="preserve"><style type="text/css"> .st0{fill:#63BEDD;} .st1{fill:#A0AFB5;} .st2{fill:#A0AFB5;stroke:#737F84;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;} .st3{fill:#FFFFFF;} .st4{fill:none;stroke:#A0AFB5;stroke-width:2;stroke-miterlimit:10;} .st5{fill:#37A0E5;} .st6{fill:#4AD3AC;} .st7{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;} .st8{fill:#FBB03B;} .st9{fill:none;stroke:#F96155;stroke-width:2;stroke-miterlimit:10;} .st10{fill:#F96155;} .st11{fill:#F9F9F9;stroke:#737F84;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;} .st12{fill:#E2E6E8;stroke:#737F84;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;} </style><circle id="bg-circle" class="st0" cx="177" cy="177" r="177"/><g id="all-items"><polygon id="envelope-bg" class="st1" points="89 117 91 115 261 115 262 116 264 118 264 236 88 236 88 118 "/><polygon id="envelope-lip" class="st2" points="265 116 176 56 87 116"/><g id="screens"><g id="screen3"><path class="st3" d="M45 270c-2.8 0-5-2.2-5-5V165c0-2.8 2.2-5 5-5h144c2.8 0 5 2.2 5 5v100c0 2.8-2.2 5-5 5H45z"/><path class="st1" d="M189 161c2.2 0 4 1.8 4 4v100c0 2.2-1.8 4-4 4H45c-2.2 0-4-1.8-4-4V165c0-2.2 1.8-4 4-4H189M189 159H45c-3.3 0-6 2.7-6 6v100c0 3.3 2.7 6 6 6h144c3.3 0 6-2.7 6-6V165C195 161.7 192.3 159 189 159L189 159z"/><line class="st4" x1="108" y1="184" x2="171" y2="184"/><line class="st4" x1="108" y1="192" x2="171" y2="192"/><line class="st4" x1="108" y1="200" x2="171" y2="200"/><line class="st4" x1="108" y1="208" x2="171" y2="208"/><line class="st4" x1="108" y1="216" x2="171" y2="216"/><line class="st4" x1="108" y1="224" x2="171" y2="224"/><line class="st4" x1="108" y1="232" x2="171" y2="232"/><line class="st4" x1="108" y1="240" x2="171" y2="240"/><line class="st4" x1="108" y1="248" x2="148" y2="248"/><rect x="61.5" y="182.5" class="st5" width="41" height="43"/><path class="st5" d="M102 183v42H62v-42H102M103 182H61v44h42V182L103 182z"/><polygon class="st3" points="77 197 88 204 77 211 "/></g><g id="screen2"><path class="st3" d="M104 231c-2.8 0-5-2.2-5-5V126c0-2.8 2.2-5 5-5h144c2.8 0 5 2.2 5 5v100c0 2.8-2.2 5-5 5H104z"/><path class="st1" d="M248 122c2.2 0 4 1.8 4 4v100c0 2.2-1.8 4-4 4H104c-2.2 0-4-1.8-4-4V126c0-2.2 1.8-4 4-4H248M248 120H104c-3.3 0-6 2.7-6 6v100c0 3.3 2.7 6 6 6h144c3.3 0 6-2.7 6-6V126C254 122.7 251.3 120 248 120L248 120z"/><rect x="121" y="144" class="st6" width="39" height="41"/><path class="st6" d="M159 145v39h-37v-39H159M161 143h-41v43h41V143L161 143z"/><polyline class="st7" points="117.7 186.2 133.7 170.3 151.2 187.8 "/><polyline class="st7" points="137.2 173.7 147.5 163.4 161.1 176.9 "/><path class="st3" d="M134.6 154.7c2.1 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7 -3.7-1.7-3.7-3.7S132.5 154.7 134.6 154.7M134.6 152.7c-3.2 0-5.7 2.6-5.7 5.7s2.6 5.7 5.7 5.7 5.7-2.6 5.7-5.7S137.7 152.7 134.6 152.7L134.6 152.7z"/><rect x="168.5" y="143.5" class="st5" width="63" height="42"/><path class="st5" d="M231 144v41h-62v-41H231M232 143h-64v43h64V143L232 143z"/><polygon class="st3" points="195 158 206 165 195 172 "/><line class="st4" x1="120" y1="194" x2="232" y2="194"/><line class="st4" x1="120" y1="202" x2="232" y2="202"/><line class="st4" x1="120" y1="210" x2="189" y2="210"/></g><g id="screen1"><path class="st3" d="M163 194c-2.8 0-5-2.2-5-5V89c0-2.8 2.2-5 5-5h144c2.8 0 5 2.2 5 5v100c0 2.8-2.2 5-5 5H163z"/><path class="st1" d="M307 85c2.2 0 4 1.8 4 4v100c0 2.2-1.8 4-4 4H163c-2.2 0-4-1.8-4-4V89c0-2.2 1.8-4 4-4H307M307 83H163c-3.3 0-6 2.7-6 6v100c0 3.3 2.7 6 6 6h144c3.3 0 6-2.7 6-6V89C313 85.7 310.3 83 307 83L307 83z"/><g id="screen2sim_1_"><rect x="250.5" y="107.5" class="st8" width="40" height="41"/><path class="st8" d="M290 108v40h-39v-40H290M291 107h-41v42h41V107L291 107z"/></g><path class="st7" d="M279.4 124.6c2 4.5-0.1 9.8-4.7 11.8s-9.8-0.1-11.8-4.7c-2-4.5 0.1-9.8 4.7-11.8C272.2 117.9 277.4 120 279.4 124.6z"/><path class="st3" d="M280 129.7c-0.1 0.6-0.3 1.2-0.5 1.7 1.4 1.1 2.1 2.1 1.9 2.6 -0.3 0.7-1.5 0.9-3.8 0.4 -1.8-0.4-4.3-1.2-7.7-2.5 -3.5-1.4-6-2.8-7.6-4 -1.7-1.3-2.4-2.3-2.1-2.9 0.3-0.5 1.3-0.6 2.8-0.4 0.2-0.5 0.5-1.1 0.9-1.5 -5.2-1.4-9.1-1.7-9.8-0.5 -0.8 1.4 2 4.5 8.5 7.8 2 1 4.2 2.1 6.9 3.1 2.4 0.9 4.5 1.7 6.4 2.4 7.7 2.6 11.1 2.7 11.8 1.1C288.2 135.6 285.2 132.7 280 129.7z"/><line class="st4" x1="181" y1="108" x2="244" y2="108"/><line class="st4" x1="181" y1="116" x2="244" y2="116"/><line class="st4" x1="181" y1="124" x2="244" y2="124"/><line class="st4" x1="181" y1="132" x2="244" y2="132"/><line class="st4" x1="181" y1="140" x2="244" y2="140"/><line class="st4" x1="181" y1="148" x2="220" y2="148"/><line class="st9" x1="181" y1="165" x2="291" y2="165"/><path class="st3" d="M199 170c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5S201.8 170 199 170z"/><path class="st10" d="M199 161c2.2 0 4 1.8 4 4s-1.8 4-4 4 -4-1.8-4-4S196.8 161 199 161M199 159c-3.3 0-6 2.7-6 6s2.7 6 6 6 6-2.7 6-6S202.3 159 199 159L199 159z"/></g></g><g id="envelope-fg"><polygon class="st11" points="265 235 87 235 87 117 "/><polygon class="st12" points="265 117 265 235 176 176 "/></g></g></svg>

    </div>

    <div class="content-container">
        <h1>Welcome to We like to blog</h1>
        <p>You can log in to use our blog and customize your account.</p>
    </div>
</body>
</html>
