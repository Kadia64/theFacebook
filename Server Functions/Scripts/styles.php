<?php 
class Styles {
    public function LoginStyle() {
        echo '
            <style>
                .login-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .login-page-content {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    display: flex;
                    flex-direction: column;            
                }
                .login-page-form div {
                    width: 280px;
                    margin: 0 auto;
                    flex: 1;
                    display: grid;
                    grid-template-columns: 23% 78%;
                    row-gap: 3px;
                }
                .login-page-form div div {
                    height: 20px;                    
                }
                .login-page-form div div:nth-child(odd) {
                    margin-top: 2px;
                }
                .login-page-form div div label {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    padding-top: -10px;
                }
                .email-input,
                .password-input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--input-color);            
                    border: 1px solid black;
                    width: 180px;            
                }
                .login-buttons {
                    margin: 0 auto!important;            
                    margin-top: 10px!important;
                    width: 100px!important;
                    display: flex;
                    flex-direction: column;
                    align-items: center;    
                    gap: 50px;        
                }
                .login-buttons div {
                    flex: 1;
                }
                .login-buttons div input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    color: white;
                    background-color: var(--button-color);
                    border: 1.5px ridge;
                }
                .login-buttons div a {
                    height: 14.5px;
                }
                .login-page-text {
                    margin: 0 auto;
                    flex: 1;
                }
            </style>
        ';
    }
    public function RegisterAboutUserStyle() {
        echo '
            <style>
                .register-about-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .register-about-content {
                }
                .register-about-page-middle {
                    width: calc(var(--standard-page-width) - 270px);
                    margin: 0 auto;
                }
                .register-about-page-text {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    text-align: center;
                }
                .register-form-grid {
                    display: grid;
                    grid-template-columns: 40% 60%;
                    column-gap: 15px;
                    row-gap: 4px;
                    margin: 0 auto;
                    width: 290px;
                }
                .register-form-grid label {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .register-form-grid input,
                .register-form-grid select,
                .register-form-grid textarea {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--input-color);
                    border: 1px solid black;
                    width: 130px;
                }
                .register-form-grid textarea {
                    resize: none;
                    height: 42px;
                    width: 150px;
                }        
                .register-button {            
                    text-align: center;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }
                .register-button input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--button-color);
                    color: white;
                    border: 1.5px ridge;
                    padding: 4px;
                }
            </style>
        ';
    }
    public function RegisterUserStyle() {
        echo '
            <style>
                .register-page-window {
                    width: calc(var(--standard-page-width) - 200px);
                    margin: 0 auto;
                }
                .register-page-content p,
                .register-page-content label {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .register-page-middle {
                    width: calc(var(--standard-page-width) - 360px);
                    margin: 0 auto;
                }
                .register-page-form {            
                
                }
                .register-page-grid {
                    display: grid;
                    grid-template-columns: 40% 60%;
                }
                .register-page-grid div {
                    height: 20px;
                }
                .register-username,
                .register-status,
                .register-email,
                .register-password {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--input-color);
                    border: 1px solid black;
                }
                .register-username,
                .register-email,
                .register-password {
                    width: 180px;
                }
                .register-status {
                    width: 130px;
                }
                .register-page-checkbox {
                    display: flex;
                    gap: 5px;
                    margin-bottom: -12px;
                }
                .register-page-checkbox p {
                    flex: 11;            
                }
                .register-page-checkbox input {
                    flex: 0.5;
                }
                .register-page-password {
                    display: flex;
                    margin-left: 8px;
                }
                .register-page-password p:first-child {
                    flex: 0.5;
                    margin-top: 15px;
                    font-weight: bold;
                }
                .register-page-password p:last-child {
                    flex : 10;
                }
                .register-page-button {
                    text-align: center;
                    padding-bottom: 10px;
                }
                .register-page-button input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    color: white;
                    background-color: var(--button-color);
                    border: 1.5px ridge;
                    padding: 2px 4px 2px 4px
                }
            </style>
        ';
    }
    public function WelcomeStyle() {
        echo '
            <style>
                .welcome-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .welcome-page-buttons {
                    text-align: center;
                    padding-bottom:  10px;
                }
                .welcome-page-buttons a {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .welcome-page-content ul {
                    margin: -10px 0px 0px -15px;
                }
                .welcome-page-content p,
                .welcome-page-content ul li {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
            </style>
        ';
    }
    public function EnableCookiesStyle() {
        echo '
            <style>
                .enable-cookies-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .enable-cookies-page-content {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .enable-cookies-page-link {
                    width: 100px;
                    margin: 0 auto;
                    padding-top: 10px;
                    padding-bottom: 20px;
                }
                .enable-cookies-page-link a {
                    color: white;
                    background-color: var(--button-color);
                    text-decoration: none;
                    border: 1.5px ridge;
                    padding: 3px;
                }
            </style>
        ';
    }
    public function AboutPageStyle() {
        echo '
            <style>
                .about-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .about-page-content {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                }
                .box1,
                .box2,
                .box3 {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    padding: 6px 6px 6px 14px;
                }
                .box2-grid {
                    display: grid;
                    grid-template-columns: 30% 35%;
                    column-gap: 10px;
                    row-gap: 5px;
                    padding-top: 10px;
                }
                .box2-grid div {
                    width: 100px;
                    height: 15px;   
                }
                .box2-grid div:nth-child(even) {
                    width: 300px;
                }
                .box2-grid p {
                    margin: 0;
                }
                .box2 a,
                .box3 a {
                    color: var(--lightblue);
                    text-decoration: none;
                }
                .box2 a:hover,
                .box3 a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
                .box3-content {
                    display: flex;
                    flex-direction: column;
                    gap: 2px;
                }
                .box3-content div {
                    flex: 1;
                    line-height: 4.5px;
                }
                .about-page-back-button {
                    text-align: center;
                    padding-bottom: 15px;
                }
                .about-page-back-button a {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    color: white;
                    background-color: var(--button-color);
                    text-decoration: none;
                    padding: 3px;
                    border: 1.5px ridge;
                }
            </style>
        ';
    }
    public function ContactUsPageStyle() {
        echo '
            <style>
                .contact-us-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .box1-grid {
                    display: grid;
                    grid-template-columns: 30% 35%;
                    column-gap: 15px;
                    row-gap: 5px;
                    padding: 12px;
                }
                .box1-grid div {
                    width: 150px;
                    height: 15px;  
                }
                .box1-grid p {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    margin: 0;
                }
                .box1-grid p a {
                    color: var(--lightblue);
                    text-decoration: none;
                }
                .box1-grid p a:hover {
                    text-decoration: underline;
                    color: var(--hover-lightblue);
                }
                .contact-us-page-back-button {
                    text-align: center;
                    padding: 15px 0px 15px 0px;
                }
                .contact-us-page-back-button a {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    color: white;
                    background-color: var(--button-color);
                    text-decoration: none;
                    padding: 3px;
                    border: 1.5px ridge;
                }
            </style>
        ';
    }
    public function JobDescriptionPageStyle() {
        echo '
            <style>
                .job-description-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .job-description-page-content {
                    text-align: left!important;
                }
                .job-description-page-content h3 {
                    font-family: var(--font);
                    font-size: 13.8px;
                    font-weight: bold;
                    margin-left: 10px;
                }
                .job-description-page-content ul {
                    width: calc(var(--standard-page-width) - 200px);
                }
                .parent-list li {
                    font-family: var(--font)!important;
                    font-size: calc(var(--content-font-size) + 1px)!important;
                    margin-left: -14.5px;
                }
                .parent-list li p {
                    margin: 0;
                }
                .parent-list li p.parent-title {
                    margin-left: -4px;
                }
                .parent-list li p.parent-text {
                    margin-left: -12px;
                    padding: 0;
                }
                .sub-list {
                    list-style-type: none;
                }
                .sub-list li {
                    margin-left: -30px;
                    width: calc(var(--standard-page-width) - 210px)!important;
                }
                .sub-list li::before {
                    content: "\2013";
                    margin-right: 5px;
                } 
                .sub-list .sub-list li {
                    margin-left: -55px;
                }
                .job-description-pagea-bottom {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    margin-left: 25px;
                }
                .job-description-pagea-bottom a {
                    color: var(--lightblue);
                    text-decoration: none;
                }
                .job-description-pagea-bottom a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
            </style>
        ';
    }    
    public function FAQPageStyle() {
        echo '
            <style>
                .faq-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .faq-page-content {
                    display: flex;
                    flex-direction: column;
                    gap: 14px;
                    margin-bottom: 14px;
                }        
                .faq-page-list li {
                    margin: -3.5px auto auto -25px;
                }
                .faq-page-list li a,
                .annual-page-content-box div:last-child p a {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    color: var(--lightblue);
                    text-decoration: none;
                    margin-left: -4px;
                }
                .faq-page-list li a:hover,
                .annual-page-content-box div:last-child p a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
                .annual-page-content-box div:last-child {
                    padding: 5px 15px 5px 12px;
                }
                .annual-page-content-box div:last-child p,
                .annual-page-content-box div:last-child p a {
                    font-family: var(--font);
                    font-size: calc(var(--content-font-size) - 1px);
                }
                .annual-page-content-box div:last-child p a {
                    margin: auto!important;
                }
            </style>
        ';
    }
    public function TermsPageStyle() {
        echo '
            <style>
                .terms-page-window {
                    width: calc(var(--standard-page-width) - 240px)!important;
                    margin-left: 35px;
                }
                .terms-page-content {
                    display: flex;
                    flex-direction: column;
                    gap: 14px;
                    margin-bottom: 14px;
                }
                .annual-page-content-box div:last-child {            
                    padding: 5px 10px 5px 12px;
                }
                .annual-page-content-box div:last-child p,
                .annual-page-content-box div:last-child a {
                    font-family: var(--font);
                    font-size: calc(var(--content-font-size) - 1px);
                }
                .annual-page-content-box div:last-child a {
                    color: var(--lightblue);
                    text-decoration: none;
                }
                .annual-page-content-box div:last-child a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
            </style>
        ';
    }
    public function PrivacyPolicyPageStyle() {
        echo '
            <style>
                .privacy-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .privacy-page-content {
                    display: flex;
                    flex-direction: column;
                    gap: 14px;
                    margin-bottom: 14px;
                }
                .privacy-page-content div {
                    flex: 1;
                }
                .annual-page-content-box div:last-child {
                    padding: 5px 10px 5px 12px;
                }
                .annual-page-content-box div:last-child p {
                    font-family: var(--font);
                    font-size: calc(var(--content-font-size) - 1px);
                }
                .annual-page-content-box div:last-child a {
                    color: var(--lightblue);
                    text-decoration: none;
                }
                .annual-page-content-box div:last-child a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
            </style>
        ';
    }
    public function MainProfilePageStyle() {
        echo "
            <style>
                .main-profile-page-window {
                    width: calc(var(--standard-page-width) - 180px);
                    margin: 0 auto;
                }
                .main-profile-page-flexbox {
                    display: flex;
                    padding: 10px;
                    width: 480px;
                    margin: 0 auto;
                    gap: 10px;
                }
                .main-profile-page-left {         
                    flex: 1.35;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                .main-profile-page-right {
                    flex: 2;
                    display: flex;
                    flex-direction: column;
                    gap: 14px;
                }                
                .window-content:first-child {
                    overflow: hidden;    
                }
                .profile-image-window img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .profile-links-window {
                    height: 78px;
                }
                .profile-links-window ul {
                    margin-left: -40px;
                    margin-top: 0px;
                    list-style-type: none;
                }
                .profile-links-window ul li:nth-child(odd):not(.profile-links-window ul li:first-child) {
                    border-top: 1px solid var(--darkblue);
                }
                .profile-links-window ul li:first-child {
                    border-bottom: 1px solid var(--darkblue);
                }
                .profile-links-window ul li:last-child {
                    border-top:  1px solid var(--darkblue);
                }
                .profile-links-window ul li a {
                    font-family: var(--font);
                    font-size: calc(var(--font-size) + 1.5px);
                    color: var(--lightblue);
                    text-decoration: none;
                    margin-left: 4px;
                }
                .profile-links-window ul li a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
                .empty-connection-window,
                .other-schools-window {
                    text-align: center;
                }                
                .window-text {
                    text-align: left!important;
                }
                .empty-connection-window p,
                .other-schools-window p {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    padding: 10px;
                }
                .main-profile-page-info-grid {
                    margin: 1px 9.5px 10px 0px;
                    display: grid;
                    grid-template-columns: 45% 35%;
                    column-gap: 10px;
                    row-gap: 2px;
                    width: 265px;
                    float: right;
                    word-wrap: break-word!important;
                }
                .main-profile-page-info-grid div {
                    width: 120px;
                }
                .main-profile-page-info-grid p {
                    font-family: var(--font);
                    font-size: 10.5px;                /* ATTRIBUTES */
                    display: inline;            
                }
                .main-profile-page-groups {
                    line-height: 12px;
                }
                .main-profile-page-groups a {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    color: var(--lightblue);
                    text-decoration: none;
                }
                .main-profile-page-groups span {
                    color: black;
                    position: relative;
                    top: 1.5px;
                    font-size: 18px;
                }
                .no-groups,
                .no-courses {
                    text-align: center;
                    font-family: var(--font);
                    font-size: var(--font-size);
                }
                .main-profile-page-courses {
                    line-height: 12px;
                    margin-left: -10px;
                }
                .main-profile-page-courses ul {
                    margin: 8px;
                    margin-left: -6px;
                }
                .main-profile-page-courses ul li {
                    font-family: var(--font);
                    font-size: var(--font-size);                    
                }
                .main-profile-page-wall {
                    line-height: 12px;
                    text-align: center;
                }
                .main-profile-page-wall div {
                    font-family: var(--font);
                    font-size: var(--font-size);
                }
                .main-profile-page-friends {
                    line-height: 12px;
                    text-align: center;
                }
                .main-profile-page-friends div {
                    font-family: var(--font);
                    font-size: var(--font-size);
                }

                .main-profile-update-grid {
                    display: grid;
                    grid-template-columns: 45% 35%;
                    column-gap: 25px;
                    row-gap: 4px;
                    width: 240px!important;
                }
                .main-profile-update-grid div {
                    width: 120px!important;
                }
                .profile-update-input {
                    margin-left: -10px;
                }
                .profile-update-input input,
                .profile-update-input select,
                .profile-update-input textarea {
                    font-family: var(--font);
                    font-size: 10.5px;
                    background-color: var(--input-color);
                    border: 1px solid black;
                }
                .profile-update-input select {
                    width: 120px;
                }
                .profile-update-input textarea {
                    resize: none;
                    height: 42px;
                    width: 135px;
                }
                .profile-update-info-button {
                    text-align: center;
                    margin: 10px 0px 0px 65px;                    
                }
                .profile-update-info-button input {
                    background-color: var(--button-color);
                    font-family: var(--font);
                    font-size: var(--font-size);
                    color: white;
                    border: 1.5px ridge;
                    padding: 3px;
                }
            </style>
        ";
    }
    public function UserHomePageStyle() {
        echo "
            <style>
                .window-content {
                    width: 475px!important;
                    flex: 1!important;
                }
                .user-home-page-window {
                    width: calc(var(--standard-page-width) - 180px);
                    margin: 0 auto;
                }
                .user-home-page-content {
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                    gap: 6px;
                    padding: 10px;
                }
                .my-account-box {
                    display: flex;
                    flex-direction: row;
                }
                .user-home-page-profile-image-flexbox {
                    flex: 1;
                }
                .user-home-page-profile-image img {
                    width: 120px;
                    height: 100%;
                    object-fit: cover;
                }
                .user-home-page-links-flexbox {
                    flex: 1;
                    width: 200px!important;
                }        
                .user-home-page-links {
                    margin-top: 18px;
                    margin-left: 6px;
                    line-height: 20px;
                    width: 115px;
                }
                .user-home-page-links p {
                    margin: 0;                        
                    border-left: 1px solid var(--darkblue);
                    border-right: 1px solid var(--darkblue);
                }
                .user-home-page-links p:first-child {
                    border-top: 1px solid var(--darkblue);
                }
                .user-home-page-links p:last-child {
                    border-bottom: 1px solid var(--darkblue);
                    border-top: 1px solid var(--darkblue);
                }
                .user-home-page-links p:not(:first-child):not(:last-child) {
                    border-top: 1px solid var(--darkblue);
                }
                .user-home-page-links a {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    color: var(--lightblue);
                    text-decoration: none;
                    font-size: 12px;
                    margin-left: 3px;  
                }
                .user-home-page-links a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
                .user-home-page-connections-flexbox {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    flex: 1;
                    line-height: 2px;
                }
                .user-home-page-connections-flexbox div {
                    width: 120px;
                    margin-top: 25px;
                }
                .user-home-page-browse-links-flexbox {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    flex: 1;
                }
                .user-home-page-browse-links-flexbox div {
                    width: 85px;
                    margin-top: 30px;
                    line-height: 25px;
                }
                .user-home-page-browse-links-flexbox div p a {
                    color: var(--lightblue);
                    text-decoration: none;                        
                }
                .user-home-page-browse-links-flexbox div p a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
                .user-home-page-message-flexbox {
                    display: flex;
                    flex-direction: row;
                }
                .user-home-page-mail {
                    width: 70px;
                    flex: 1;
                    padding: 15px;
                }
                .mail-icon-image {
                    height: 100%;
                    width: 100%;
                }
                .user-home-page-message-count {
                    flex: 1;
                    margin-top: 27px;
                }
                .user-home-page-message-count p {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    width: 200px;
                }
                .user-home-page-read-mail-button {
                    flex: 1;
                    margin-top: 35px;
                }
                .user-home-page-read-mail-button a {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    text-decoration: none;
                    color: var(--lightblue);            
                    float: right;
                    margin-right: 15px;
                }
                .user-home-page-read-mail-button a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
            </style>
        ";
    }
    public function SearchPageStyle() {
        echo '';
    }
    public function ProfilePageStyle() {
        echo '';
    }
}
?>