<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = urlencode($_POST['text']);
    $from = $_POST['from'];
    $to = $_POST['to'];

    $api_url = "https://translator.bjcoderx.workers.dev/?text=$text&fr=$from&to=$to";
    $response = file_get_contents($api_url);
    $result = json_decode($response, true);
} else {
    // Default language selection
    $from = "en";  // Default from language
    $to = "ur";    // Default to language
}

// Function to keep selected value in dropdown
function isSelected($value, $selectedValue) {
    return ($value === $selectedValue) ? "selected" : "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJ Global Linguistics ðŸ§‘â€ðŸ«</title>
    <style>
        /* Global Styles */
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .header {
    background-color: #121212; /* Black Background */
    color: #0ff; /* Blue Text */
    padding: 15px;
    font-size: 24px;
    font-weight: bold;
    border-top: 2px solid #0ff; /* Blue Stroke on Top */
    border-bottom: 1px solid #0ff; /* Blue Stroke on Bottom */
}

        /* Main Container */
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
        }

        /* Row Layout */
        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Form Elements */
        select, input, button {
            background: #1a1a1a;
            color: #0ff;
            border: 1px solid #0ff;
            border-radius: 5px;
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }

        /* Swap Button */
        .swap-btn {
            background: transparent;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #0ff;
        }

        .output {
    position: relative; /* Parent ko relative banana zaroori hai */
    background: #1a1a1a;
    padding: 20px;
    margin-top: 9px;
    border-radius: 5px;
    min-height: 50px;
    text-align: left;
    width: 90%;
    margin-left: auto;
    margin-right: auto;
}

.copy-btn {
    position: absolute;
    right: 10px;  /* Output box ke right side par fix */
    bottom: 4px; /* Output box ke bottom par fix */
    background: #0ff;
    border: none;
    padding: 5px;
    cursor: pointer;
    border-radius: 3px;
    font-size: 12px;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
}



        /* Footer */
        .footer {
    background-color: #121212; /* Black Background */
    color: #0ff; /* Blue Text */
    text-align: center;
    padding: 10px;
    font-size: 14px;
    border-top: 1px solid #0ff; /* Blue Stroke on Top */
    border-bottom: 1px solid #0ff; /* Blue Stroke on Bottom */
    position: fixed;
    bottom: 0;
    width: 100%;
}
    </style>
</head>
<body>

    <div class="header">
        BJ Global Linguistics ðŸ§‘â€ðŸ«
    </div>

    <div class="container">
        <form method="POST">
            <div class="row">
                <select name="from">
<option value="auto" <?= isSelected('auto', $from) ?>>ðŸŒ Auto Detect</option>
<option value="en" <?= isSelected('en', $from) ?>>ðŸ‡¬ðŸ‡§ English</option>
<option value="ur" <?= isSelected('ur', $from) ?>>ðŸ‡µðŸ‡° Urdu</option>
<option value="sd" <?= isSelected('sd', $from) ?>>ðŸ‡µðŸ‡° Sindhi</option>
<option value="bn" <?= isSelected('bn', $from) ?>>ðŸ‡§ðŸ‡© Bengali</option>
<option value="hi" <?= isSelected('hi', $from) ?>>ðŸ‡®ðŸ‡³ Hindi</option>
<option value="ne" <?= isSelected('ne', $from) ?>>ðŸ‡³ðŸ‡µ Nepali</option>
<option value="pa" <?= isSelected('pa', $from) ?>>ðŸ‡®ðŸ‡³ Punjabi</option>
<option value="ta" <?= isSelected('ta', $from) ?>>ðŸ‡®ðŸ‡³ Tamil</option>
<option value="te" <?= isSelected('te', $from) ?>>ðŸ‡®ðŸ‡³ Telugu</option>
<option value="ml" <?= isSelected('ml', $from) ?>>ðŸ‡®ðŸ‡³ Malayalam</option>
<option value="mr" <?= isSelected('mr', $from) ?>>ðŸ‡®ðŸ‡³ Marathi</option>
<option value="gu" <?= isSelected('gu', $from) ?>>ðŸ‡®ðŸ‡³ Gujarati</option>
<option value="kn" <?= isSelected('kn', $from) ?>>ðŸ‡®ðŸ‡³ Kannada</option>

<!-- Google Translate Supported Languages -->
<option value="af" <?= isSelected('af', $from) ?>>ðŸ‡¿ðŸ‡¦ Afrikaans</option>
<option value="sq" <?= isSelected('sq', $from) ?>>ðŸ‡¦ðŸ‡± Albanian</option>
<option value="am" <?= isSelected('am', $from) ?>>ðŸ‡ªðŸ‡¹ Amharic</option>
<option value="ar" <?= isSelected('ar', $from) ?>>ðŸ‡¸ðŸ‡¦ Arabic</option>
<option value="hy" <?= isSelected('hy', $from) ?>>ðŸ‡¦ðŸ‡² Armenian</option>
<option value="az" <?= isSelected('az', $from) ?>>ðŸ‡¦ðŸ‡¿ Azerbaijani</option>
<option value="eu" <?= isSelected('eu', $from) ?>>ðŸ‡ªðŸ‡¸ Basque</option>
<option value="be" <?= isSelected('be', $from) ?>>ðŸ‡§ðŸ‡¾ Belarusian</option>
<option value="bs" <?= isSelected('bs', $from) ?>>ðŸ‡§ðŸ‡¦ Bosnian</option>
<option value="bg" <?= isSelected('bg', $from) ?>>ðŸ‡§ðŸ‡¬ Bulgarian</option>
<option value="ca" <?= isSelected('ca', $from) ?>>ðŸ‡ªðŸ‡¸ Catalan</option>
<option value="ceb" <?= isSelected('ceb', $from) ?>>ðŸ‡µðŸ‡­ Cebuano</option>
<option value="ny" <?= isSelected('ny', $from) ?>>ðŸ‡²ðŸ‡¼ Chichewa</option>
<option value="zh" <?= isSelected('zh', $from) ?>>ðŸ‡¨ðŸ‡³ Chinese</option>
<option value="co" <?= isSelected('co', $from) ?>>ðŸ‡«ðŸ‡· Corsican</option>
<option value="hr" <?= isSelected('hr', $from) ?>>ðŸ‡­ðŸ‡· Croatian</option>
<option value="cs" <?= isSelected('cs', $from) ?>>ðŸ‡¨ðŸ‡¿ Czech</option>
<option value="da" <?= isSelected('da', $from) ?>>ðŸ‡©ðŸ‡° Danish</option>
<option value="nl" <?= isSelected('nl', $from) ?>>ðŸ‡³ðŸ‡± Dutch</option>
<option value="eo" <?= isSelected('eo', $from) ?>>ðŸŒ Esperanto</option>
<option value="et" <?= isSelected('et', $from) ?>>ðŸ‡ªðŸ‡ª Estonian</option>
<option value="tl" <?= isSelected('tl', $from) ?>>ðŸ‡µðŸ‡­ Filipino</option>
<option value="fi" <?= isSelected('fi', $from) ?>>ðŸ‡«ðŸ‡® Finnish</option>
<option value="fr" <?= isSelected('fr', $from) ?>>ðŸ‡«ðŸ‡· French</option>
<option value="gl" <?= isSelected('gl', $from) ?>>ðŸ‡ªðŸ‡¸ Galician</option>
<option value="ka" <?= isSelected('ka', $from) ?>>ðŸ‡¬ðŸ‡ª Georgian</option>
<option value="de" <?= isSelected('de', $from) ?>>ðŸ‡©ðŸ‡ª German</option>
<option value="el" <?= isSelected('el', $from) ?>>ðŸ‡¬ðŸ‡· Greek</option>
<option value="ht" <?= isSelected('ht', $from) ?>>ðŸ‡­ðŸ‡¹ Haitian Creole</option>
<option value="ha" <?= isSelected('ha', $from) ?>>ðŸ‡³ðŸ‡¬ Hausa</option>
<option value="haw" <?= isSelected('haw', $from) ?>>ðŸ‡ºðŸ‡¸ Hawaiian</option>
<option value="iw" <?= isSelected('iw', $from) ?>>ðŸ‡®ðŸ‡± Hebrew</option>
<option value="hu" <?= isSelected('hu', $from) ?>>ðŸ‡­ðŸ‡º Hungarian</option>
<option value="is" <?= isSelected('is', $from) ?>>ðŸ‡®ðŸ‡¸ Icelandic</option>
<option value="id" <?= isSelected('id', $from) ?>>ðŸ‡®ðŸ‡© Indonesian</option>
<option value="ga" <?= isSelected('ga', $from) ?>>ðŸ‡®ðŸ‡ª Irish</option>
<option value="it" <?= isSelected('it', $from) ?>>ðŸ‡®ðŸ‡¹ Italian</option>
<option value="ja" <?= isSelected('ja', $from) ?>>ðŸ‡¯ðŸ‡µ Japanese</option>
<option value="jw" <?= isSelected('jw', $from) ?>>ðŸ‡®ðŸ‡© Javanese</option>
<option value="kk" <?= isSelected('kk', $from) ?>>ðŸ‡°ðŸ‡¿ Kazakh</option>
<option value="km" <?= isSelected('km', $from) ?>>ðŸ‡°ðŸ‡­ Khmer</option>
<option value="ko" <?= isSelected('ko', $from) ?>>ðŸ‡°ðŸ‡· Korean</option>
<option value="ku" <?= isSelected('ku', $from) ?>>ðŸ‡®ðŸ‡¶ Kurdish</option>
<option value="ky" <?= isSelected('ky', $from) ?>>ðŸ‡°ðŸ‡¬ Kyrgyz</option>
<option value="lo" <?= isSelected('lo', $from) ?>>ðŸ‡±ðŸ‡¦ Lao</option>
<option value="la" <?= isSelected('la', $from) ?>>ðŸŒ Latin</option>
<option value="lv" <?= isSelected('lv', $from) ?>>ðŸ‡±ðŸ‡» Latvian</option>
<option value="lt" <?= isSelected('lt', $from) ?>>ðŸ‡±ðŸ‡¹ Lithuanian</option>
<option value="mk" <?= isSelected('mk', $from) ?>>ðŸ‡²ðŸ‡° Macedonian</option>
<option value="mg" <?= isSelected('mg', $from) ?>>ðŸ‡²ðŸ‡¬ Malagasy</option>
<option value="ms" <?= isSelected('ms', $from) ?>>ðŸ‡²ðŸ‡¾ Malay</option>
<option value="mt" <?= isSelected('mt', $from) ?>>ðŸ‡²ðŸ‡¹ Maltese</option>
<option value="no" <?= isSelected('no', $from) ?>>ðŸ‡³ðŸ‡´ Norwegian</option>
<option value="ps" <?= isSelected('ps', $from) ?>>ðŸ‡¦ðŸ‡« Pashto</option>
<option value="fa" <?= isSelected('fa', $from) ?>>ðŸ‡®ðŸ‡· Persian</option>
<option value="pl" <?= isSelected('pl', $from) ?>>ðŸ‡µðŸ‡± Polish</option>
<option value="pt" <?= isSelected('pt', $from) ?>>ðŸ‡µðŸ‡¹ Portuguese</option>
<option value="ro" <?= isSelected('ro', $from) ?>>ðŸ‡·ðŸ‡´ Romanian</option>
<option value="ru" <?= isSelected('ru', $from) ?>>ðŸ‡·ðŸ‡º Russian</option>
<option value="es" <?= isSelected('es', $from) ?>>ðŸ‡ªðŸ‡¸ Spanish</option>
<option value="th" <?= isSelected('th', $from) ?>>ðŸ‡¹ðŸ‡­ Thai</option>
<option value="tr" <?= isSelected('tr', $from) ?>>ðŸ‡¹ðŸ‡· Turkish</option>
<option value="uk" <?= isSelected('uk', $from) ?>>ðŸ‡ºðŸ‡¦ Ukrainian</option>
<option value="uz" <?= isSelected('uz', $from) ?>>ðŸ‡ºðŸ‡¿ Uzbek</option>
<option value="vi" <?= isSelected('vi', $from) ?>>ðŸ‡»ðŸ‡³ Vietnamese</option>
<option value="zu" <?= isSelected('zu', $from) ?>>ðŸ‡¿ðŸ‡¦ Zulu</option>

                </select>

                <button class="swap-btn" type="button" onclick="swapLanguages()">&#8646;</button>

                <select name="to">
<option value="ur" <?= isSelected('ur', $to) ?>>ðŸ‡µðŸ‡° Urdu</option>
<option value="en" <?= isSelected('en', $to) ?>>ðŸ‡¬ðŸ‡§ English</option>
<option value="sd" <?= isSelected('sd', $to) ?>>ðŸ‡µðŸ‡° Sindhi</option>
<option value="bn" <?= isSelected('bn', $to) ?>>ðŸ‡§ðŸ‡© Bengali</option>
<option value="hi" <?= isSelected('hi', $to) ?>>ðŸ‡®ðŸ‡³ Hindi</option>
<option value="ne" <?= isSelected('ne', $to) ?>>ðŸ‡³ðŸ‡µ Nepali</option>
<option value="pa" <?= isSelected('pa', $to) ?>>ðŸ‡®ðŸ‡³ Punjabi</option>
<option value="ta" <?= isSelected('ta', $to) ?>>ðŸ‡®ðŸ‡³ Tamil</option>
<option value="te" <?= isSelected('te', $to) ?>>ðŸ‡®ðŸ‡³ Telugu</option>
<option value="ml" <?= isSelected('ml', $to) ?>>ðŸ‡®ðŸ‡³ Malayalam</option>
<option value="mr" <?= isSelected('mr', $to) ?>>ðŸ‡®ðŸ‡³ Marathi</option>
<option value="gu" <?= isSelected('gu', $to) ?>>ðŸ‡®ðŸ‡³ Gujarati</option>
<option value="kn" <?= isSelected('kn', $to) ?>>ðŸ‡®ðŸ‡³ Kannada</option>

<!-- Google Translate Supported Languages -->
<option value="af" <?= isSelected('af', $to) ?>>ðŸ‡¿ðŸ‡¦ Afrikaans</option>
<option value="sq" <?= isSelected('sq', $to) ?>>ðŸ‡¦ðŸ‡± Albanian</option>
<option value="am" <?= isSelected('am', $to) ?>>ðŸ‡ªðŸ‡¹ Amharic</option>
<option value="ar" <?= isSelected('ar', $to) ?>>ðŸ‡¸ðŸ‡¦ Arabic</option>
<option value="hy" <?= isSelected('hy', $to) ?>>ðŸ‡¦ðŸ‡² Armenian</option>
<option value="az" <?= isSelected('az', $to) ?>>ðŸ‡¦ðŸ‡¿ Azerbaijani</option>
<option value="eu" <?= isSelected('eu', $to) ?>>ðŸ‡ªðŸ‡¸ Basque</option>
<option value="be" <?= isSelected('be', $to) ?>>ðŸ‡§ðŸ‡¾ Belarusian</option>
<option value="bs" <?= isSelected('bs', $to) ?>>ðŸ‡§ðŸ‡¦ Bosnian</option>
<option value="bg" <?= isSelected('bg', $to) ?>>ðŸ‡§ðŸ‡¬ Bulgarian</option>
<option value="ca" <?= isSelected('ca', $to) ?>>ðŸ‡ªðŸ‡¸ Catalan</option>
<option value="ceb" <?= isSelected('ceb', $to) ?>>ðŸ‡µðŸ‡­ Cebuano</option>
<option value="ny" <?= isSelected('ny', $to) ?>>ðŸ‡²ðŸ‡¼ Chichewa</option>
<option value="zh" <?= isSelected('zh', $to) ?>>ðŸ‡¨ðŸ‡³ Chinese</option>
<option value="co" <?= isSelected('co', $to) ?>>ðŸ‡«ðŸ‡· Corsican</option>
<option value="hr" <?= isSelected('hr', $to) ?>>ðŸ‡­ðŸ‡· Croatian</option>
<option value="cs" <?= isSelected('cs', $to) ?>>ðŸ‡¨ðŸ‡¿ Czech</option>
<option value="da" <?= isSelected('da', $to) ?>>ðŸ‡©ðŸ‡° Danish</option>
<option value="nl" <?= isSelected('nl', $to) ?>>ðŸ‡³ðŸ‡± Dutch</option>
<option value="eo" <?= isSelected('eo', $to) ?>>ðŸŒ Esperanto</option>
<option value="et" <?= isSelected('et', $to) ?>>ðŸ‡ªðŸ‡ª Estonian</option>
<option value="tl" <?= isSelected('tl', $to) ?>>ðŸ‡µðŸ‡­ Filipino</option>
<option value="fi" <?= isSelected('fi', $to) ?>>ðŸ‡«ðŸ‡® Finnish</option>
<option value="fr" <?= isSelected('fr', $to) ?>>ðŸ‡«ðŸ‡· French</option>
<option value="gl" <?= isSelected('gl', $to) ?>>ðŸ‡ªðŸ‡¸ Galician</option>
<option value="ka" <?= isSelected('ka', $to) ?>>ðŸ‡¬ðŸ‡ª Georgian</option>
<option value="de" <?= isSelected('de', $to) ?>>ðŸ‡©ðŸ‡ª German</option>
<option value="el" <?= isSelected('el', $to) ?>>ðŸ‡¬ðŸ‡· Greek</option>
<option value="ht" <?= isSelected('ht', $to) ?>>ðŸ‡­ðŸ‡¹ Haitian Creole</option>
<option value="ha" <?= isSelected('ha', $to) ?>>ðŸ‡³ðŸ‡¬ Hausa</option>
<option value="haw" <?= isSelected('haw', $to) ?>>ðŸ‡ºðŸ‡¸ Hawaiian</option>
<option value="iw" <?= isSelected('iw', $to) ?>>ðŸ‡®ðŸ‡± Hebrew</option>
<option value="hu" <?= isSelected('hu', $to) ?>>ðŸ‡­ðŸ‡º Hungarian</option>
<option value="is" <?= isSelected('is', $to) ?>>ðŸ‡®ðŸ‡¸ Icelandic</option>
<option value="id" <?= isSelected('id', $to) ?>>ðŸ‡®ðŸ‡© Indonesian</option>
<option value="ga" <?= isSelected('ga', $to) ?>>ðŸ‡®ðŸ‡ª Irish</option>
<option value="it" <?= isSelected('it', $to) ?>>ðŸ‡®ðŸ‡¹ Italian</option>
<option value="ja" <?= isSelected('ja', $to) ?>>ðŸ‡¯ðŸ‡µ Japanese</option>
<option value="jw" <?= isSelected('jw', $to) ?>>ðŸ‡®ðŸ‡© Javanese</option>
<option value="kk" <?= isSelected('kk', $to) ?>>ðŸ‡°ðŸ‡¿ Kazakh</option>
<option value="km" <?= isSelected('km', $to) ?>>ðŸ‡°ðŸ‡­ Khmer</option>
<option value="ko" <?= isSelected('ko', $to) ?>>ðŸ‡°ðŸ‡· Korean</option>
<option value="ku" <?= isSelected('ku', $to) ?>>ðŸ‡®ðŸ‡¶ Kurdish</option>
<option value="ky" <?= isSelected('ky', $to) ?>>ðŸ‡°ðŸ‡¬ Kyrgyz</option>
<option value="lo" <?= isSelected('lo', $to) ?>>ðŸ‡±ðŸ‡¦ Lao</option>
<option value="la" <?= isSelected('la', $to) ?>>ðŸŒ Latin</option>
<option value="lv" <?= isSelected('lv', $to) ?>>ðŸ‡±ðŸ‡» Latvian</option>
<option value="lt" <?= isSelected('lt', $to) ?>>ðŸ‡±ðŸ‡¹ Lithuanian</option>
<option value="mk" <?= isSelected('mk', $to) ?>>ðŸ‡²ðŸ‡° Macedonian</option>
<option value="mg" <?= isSelected('mg', $to) ?>>ðŸ‡²ðŸ‡¬ Malagasy</option>
<option value="ms" <?= isSelected('ms', $to) ?>>ðŸ‡²ðŸ‡¾ Malay</option>
<option value="mt" <?= isSelected('mt', $to) ?>>ðŸ‡²ðŸ‡¹ Maltese</option>
<option value="no" <?= isSelected('no', $to) ?>>ðŸ‡³ðŸ‡´ Norwegian</option>
<option value="ps" <?= isSelected('ps', $to) ?>>ðŸ‡¦ðŸ‡« Pashto</option>
<option value="fa" <?= isSelected('fa', $to) ?>>ðŸ‡®ðŸ‡· Persian</option>
<option value="pl" <?= isSelected('pl', $to) ?>>ðŸ‡µðŸ‡± Polish</option>
<option value="pt" <?= isSelected('pt', $to) ?>>ðŸ‡µðŸ‡¹ Portuguese</option>
<option value="ro" <?= isSelected('ro', $to) ?>>ðŸ‡·ðŸ‡´ Romanian</option>
<option value="ru" <?= isSelected('ru', $to) ?>>ðŸ‡·ðŸ‡º Russian</option>
<option value="es" <?= isSelected('es', $to) ?>>ðŸ‡ªðŸ‡¸ Spanish</option>
<option value="th" <?= isSelected('th', $to) ?>>ðŸ‡¹ðŸ‡­ Thai</option>
<option value="tr" <?= isSelected('tr', $to) ?>>ðŸ‡¹ðŸ‡· Turkish</option>
<option value="uk" <?= isSelected('uk', $to) ?>>ðŸ‡ºðŸ‡¦ Ukrainian</option>
<option value="uz" <?= isSelected('uz', $to) ?>>ðŸ‡ºðŸ‡¿ Uzbek</option>
<option value="vi" <?= isSelected('vi', $to) ?>>ðŸ‡»ðŸ‡³ Vietnamese</option>
<option value="zu" <?= isSelected('zu', $to) ?>>ðŸ‡¿ðŸ‡¦ Zulu</option>
                </select>
            </div>

            <input type="text" name="text" placeholder="Enter text" required value="<?= isset($_POST['text']) ? htmlspecialchars($_POST['text']) : '' ?>">
            <button type="submit">Translate</button>
        </form>
        
        <div class="output" id="translationOutput">
            <?php if (isset($result['translated_text'])): ?>
                <button class="copy-btn" onclick="copyText()">ðŸ“‹</button>
                <p><strong>Translation:</strong> <span id="translatedText"><?php echo htmlspecialchars($result['translated_text']); ?></span></p>
            <?php elseif (isset($response)): ?>
                <p>Error fetching translation!</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        Â© 2025 BJ Tricks | <a href="https://t.me/BJ_Devs" style="color: #e50914;">Learn More About Us</a>
    </div>

    <script>
    function isSelected($option, $selectedValue) {
    return $option === $selectedValue ? 'selected' : '';
}
        function swapLanguages() {
            let from = document.querySelector('select[name="from"]');
            let to = document.querySelector('select[name="to"]');
            [from.value, to.value] = [to.value, from.value];
        }

        function copyText() {
            let text = document.getElementById('translatedText').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Copied to clipboard');
            });
        }
    </script>

</body>
</html>
