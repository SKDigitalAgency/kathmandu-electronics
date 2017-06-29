<?php
session_start();
include_once("functions.php");
?>

<?php include_once("meta.php"); ?>
<body>
<?php include_once("header.php"); ?>
<main>
    <div class="container">
    <?php if(isset($_GET["search"]) && isset($_GET["keywords"]) && $_GET["keywords"] != NULL): ?>

        <?php search($_GET["keywords"]); ?>

    <?php else: ?>
    <div class="privacy_policy">
        <h2>Privacy Policy</h2>

        <p>What personal information do we collect from the people that visit our blog, website or app?</p>

        <p>When ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, mailing address, phone number, Address or other details to help you with your experience.</p>

        <h2>When do we collect information?</h2>

        <p>We collect information from you when you register on our site, place an order, subscribe to a newsletter or enter information on our site.</p>


        <h2>How do we use your information?</h2>

        <p>We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:</p>
        <ul>
            <li>To personalize your experience and to allow us to deliver the type of content and product offerings in which you are most interested.</li>
            <li>To allow us to better service you in responding to your customer service requests.</li>
            <li>To send periodic emails regarding your order or other products and services.</li>
        </ul>

        <h2>How do we protect your information?</h2>

        <p>We do not use vulnerability scanning and/or scanning to PCI standards.</p>
        <p>We only provide articles and information. We never ask for credit card numbers.</p>

        <p>We do not use an SSL certificate</p>
        <p>• We only provide articles and information. We never ask for personal or private information like names, email addresses, or credit card numbers.</p>

        <h2>Do we use 'cookies'?</h2>

        <p>Yes. Cookies are small files that a site or its service provider transfers to your computer's hard drive through your Web browser (if you allow) that enables the site's or service provider's systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.</p>

        <p>We use cookies to:</p>
        <ul>
            <li>Understand and save user's preferences for future visits.</li>
            <li>Keep track of advertisements.</li>
            <li>Compile aggregate data about site traffic and site interactions in order to offer better site experiences and tools in the future. We may also use trusted third-party services that track this information on our behalf.</li>
        </ul>

        <p>You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since browser is a little different, look at your browser's Help Menu to learn the correct way to modify your cookies.</p>

        <p>If you turn cookies off, some features will be disabled. It won't affect the user's experience that make your site experience more efficient and may not function properly.</p>


        <h2>Third-party disclosure</h2>

        <p>We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it's release is appropriate to comply with the law, enforce our site policies, or protect ours or others' rights, property or safety.</p>

        <p>However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.</p>

    <h2>Third-party links</h2>

    <p>Occasionally, at our discretion, we may include or offer third-party products or services on our website. These third-party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</p>

        <h2>Google</h2>

    <p>Google's advertising requirements can be summed up by Google's Advertising Principles. They are put in place to provide a positive experience for users.</p>

    <p>We use Google AdSense Advertising on our website.</p>

    <p>Google, as a third-party vendor, uses cookies to serve ads on our site. Google's use of the DART cookie enables it to serve ads to our users based on previous visits to our site and other sites on the Internet. Users may opt-out of the use of the DART cookie by visiting the Google Ad and Content Network privacy policy.
        <ul>
            <li>Google Display Network Impression Reporting</li>
        </ul>

    <p>We have implemented the following:</p>
    <ul>
        <li>Google Display Network Impression Reporting</li>
    </ul>

    <p>We, along with third-party vendors such as Google use first-party cookies (such as the Google Analytics cookies) and third-party cookies (such as the DoubleClick cookie) or other third-party identifiers together to compile data regarding user interactions with ad impressions and other ad service functions as they relate to our website.</p>

        <h2>Opting out:</h2>
    <p>Users can set preferences for how Google advertises to you using the Google Ad Settings page. Alternatively, you can opt out by visiting the Network Advertising Initiative Opt Out page or by using the Google Analytics Opt Out Browser add on.</p>

    <p>Users can visit our site anonymously.</p>
    <p>Once this privacy policy is created, we will add a link to it on our home page or as a minimum, on the first significant page after entering our website.</p>
    <p>Our Privacy Policy link includes the word 'Privacy' and can easily be found on the page specified above.</p>

    <p>You will be notified of any Privacy Policy changes:</p>
        <ul>
            <li>On our Privacy Policy Page</li>
        </ul>
    <p>Can change your personal information:</p>
        <ul>
            <li>By logging in to your account</li>
        </ul>

        <h2>How does our site handle Do Not Track signals?</h2>
    <p>We honor Do Not Track signals and Do Not Track, plant cookies, or use advertising when a Do Not Track (DNT) browser mechanism is in place.</p>

        <h2>Does our site allow third-party behavioral tracking?</h2>
    <p>It's also important to note that we do not allow third-party behavioral tracking</p>

        <h2>Fair Information Practices</h2>
    <p> In order to implement Fair Information Practices we will take the following responsive action, should a data breach occur:</p>
    <p> We will notify you via email</p>
        <ul>
            <li>Within 7 business days</li>
        </ul>

    <p> We also agree to the Individual Redress Principle which requires that individuals have the right to legally pursue enforceable rights against data collectors and processors who fail to adhere to the law. This principle requires not only that individuals have enforceable rights against data users, but also that individuals have recourse to courts or government agencies to investigate and/or prosecute non-compliance by data processors.</p>

    <p> We collect your email address in order to:</p>
        <ul>
            <li>Send information, respond to inquiries, and/or other requests or questions</li>
            <li>Process orders and to send information and updates pertaining to orders.</li>
            <li>Send you additional information related to your product and/or service</li>
            <li>Market to our mailing list or continue to send emails to our clients after the original transaction has occurred.</li>
        </ul>

    <p> We agree to the following for email subscription service:</p>
        <ul>
            <li>Not use false or misleading subjects or email addresses.</li>
            <li>Identify the message as an advertisement in some reasonable way.</li>
            <li>Include the physical address of our business or site headquarters.</li>
            <li>Monitor third-party email marketing services for compliance, if one is used.</li>
            <li>Honor opt-out/unsubscribe requests quickly.</li>
            <li>Allow users to unsubscribe by using the link at the bottom of each email.</li>
        </ul>

    <p> If at any time you would like to unsubscribe from receiving future emails, you can email us at</p>
        <ul>
            <li>Follow the instructions at the bottom of each email.</li>
        </ul>
    <p> and we will promptly remove you from ALL correspondence.</p>


        <h2>Contacting Us</h2>

    <p> If there are any questions regarding this privacy policy, you may contact us using the information below.</p>

    <p>www.kathmanduelectronics.com</p>
    <p> mail@kathmanduelectronics.com</p>

    <p> Last Edited on 2017-02-18</p>
    </div>
    <?php endif ?>
    </div>
</main>
<?php include_once("aside.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>