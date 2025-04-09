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
    <title>BJ Global Linguistics 🧑‍🏫</title>
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
        BJ Global Linguistics 🧑‍🏫
    </div>

    <div class="container">
        <form method="POST">
            <div class="row">
                <select name="from">
<option value="auto" <?= isSelected('auto', $from) ?>>🌍 Auto Detect</option>
<option value="en" <?= isSelected('en', $from) ?>>🇬🇧 English</option>
<option value="ur" <?= isSelected('ur', $from) ?>>🇵🇰 Urdu</option>
<option value="sd" <?= isSelected('sd', $from) ?>>🇵🇰 Sindhi</option>
<option value="bn" <?= isSelected('bn', $from) ?>>🇧🇩 Bengali</option>
<option value="hi" <?= isSelected('hi', $from) ?>>🇮🇳 Hindi</option>
<option value="ne" <?= isSelected('ne', $from) ?>>🇳🇵 Nepali</option>
<option value="pa" <?= isSelected('pa', $from) ?>>🇮🇳 Punjabi</option>
<option value="ta" <?= isSelected('ta', $from) ?>>🇮🇳 Tamil</option>
<option value="te" <?= isSelected('te', $from) ?>>🇮🇳 Telugu</option>
<option value="ml" <?= isSelected('ml', $from) ?>>🇮🇳 Malayalam</option>
<option value="mr" <?= isSelected('mr', $from) ?>>🇮🇳 Marathi</option>
<option value="gu" <?= isSelected('gu', $from) ?>>🇮🇳 Gujarati</option>
<option value="kn" <?= isSelected('kn', $from) ?>>🇮🇳 Kannada</option>

<!-- Google Translate Supported Languages -->
<option value="af" <?= isSelected('af', $from) ?>>🇿🇦 Afrikaans</option>
<option value="sq" <?= isSelected('sq', $from) ?>>🇦🇱 Albanian</option>
<option value="am" <?= isSelected('am', $from) ?>>🇪🇹 Amharic</option>
<option value="ar" <?= isSelected('ar', $from) ?>>🇸🇦 Arabic</option>
<option value="hy" <?= isSelected('hy', $from) ?>>🇦🇲 Armenian</option>
<option value="az" <?= isSelected('az', $from) ?>>🇦🇿 Azerbaijani</option>
<option value="eu" <?= isSelected('eu', $from) ?>>🇪🇸 Basque</option>
<option value="be" <?= isSelected('be', $from) ?>>🇧🇾 Belarusian</option>
<option value="bs" <?= isSelected('bs', $from) ?>>🇧🇦 Bosnian</option>
<option value="bg" <?= isSelected('bg', $from) ?>>🇧🇬 Bulgarian</option>
<option value="ca" <?= isSelected('ca', $from) ?>>🇪🇸 Catalan</option>
<option value="ceb" <?= isSelected('ceb', $from) ?>>🇵🇭 Cebuano</option>
<option value="ny" <?= isSelected('ny', $from) ?>>🇲🇼 Chichewa</option>
<option value="zh" <?= isSelected('zh', $from) ?>>🇨🇳 Chinese</option>
<option value="co" <?= isSelected('co', $from) ?>>🇫🇷 Corsican</option>
<option value="hr" <?= isSelected('hr', $from) ?>>🇭🇷 Croatian</option>
<option value="cs" <?= isSelected('cs', $from) ?>>🇨🇿 Czech</option>
<option value="da" <?= isSelected('da', $from) ?>>🇩🇰 Danish</option>
<option value="nl" <?= isSelected('nl', $from) ?>>🇳🇱 Dutch</option>
<option value="eo" <?= isSelected('eo', $from) ?>>🌍 Esperanto</option>
<option value="et" <?= isSelected('et', $from) ?>>🇪🇪 Estonian</option>
<option value="tl" <?= isSelected('tl', $from) ?>>🇵🇭 Filipino</option>
<option value="fi" <?= isSelected('fi', $from) ?>>🇫🇮 Finnish</option>
<option value="fr" <?= isSelected('fr', $from) ?>>🇫🇷 French</option>
<option value="gl" <?= isSelected('gl', $from) ?>>🇪🇸 Galician</option>
<option value="ka" <?= isSelected('ka', $from) ?>>🇬🇪 Georgian</option>
<option value="de" <?= isSelected('de', $from) ?>>🇩🇪 German</option>
<option value="el" <?= isSelected('el', $from) ?>>🇬🇷 Greek</option>
<option value="ht" <?= isSelected('ht', $from) ?>>🇭🇹 Haitian Creole</option>
<option value="ha" <?= isSelected('ha', $from) ?>>🇳🇬 Hausa</option>
<option value="haw" <?= isSelected('haw', $from) ?>>🇺🇸 Hawaiian</option>
<option value="iw" <?= isSelected('iw', $from) ?>>🇮🇱 Hebrew</option>
<option value="hu" <?= isSelected('hu', $from) ?>>🇭🇺 Hungarian</option>
<option value="is" <?= isSelected('is', $from) ?>>🇮🇸 Icelandic</option>
<option value="id" <?= isSelected('id', $from) ?>>🇮🇩 Indonesian</option>
<option value="ga" <?= isSelected('ga', $from) ?>>🇮🇪 Irish</option>
<option value="it" <?= isSelected('it', $from) ?>>🇮🇹 Italian</option>
<option value="ja" <?= isSelected('ja', $from) ?>>🇯🇵 Japanese</option>
<option value="jw" <?= isSelected('jw', $from) ?>>🇮🇩 Javanese</option>
<option value="kk" <?= isSelected('kk', $from) ?>>🇰🇿 Kazakh</option>
<option value="km" <?= isSelected('km', $from) ?>>🇰🇭 Khmer</option>
<option value="ko" <?= isSelected('ko', $from) ?>>🇰🇷 Korean</option>
<option value="ku" <?= isSelected('ku', $from) ?>>🇮🇶 Kurdish</option>
<option value="ky" <?= isSelected('ky', $from) ?>>🇰🇬 Kyrgyz</option>
<option value="lo" <?= isSelected('lo', $from) ?>>🇱🇦 Lao</option>
<option value="la" <?= isSelected('la', $from) ?>>🌍 Latin</option>
<option value="lv" <?= isSelected('lv', $from) ?>>🇱🇻 Latvian</option>
<option value="lt" <?= isSelected('lt', $from) ?>>🇱🇹 Lithuanian</option>
<option value="mk" <?= isSelected('mk', $from) ?>>🇲🇰 Macedonian</option>
<option value="mg" <?= isSelected('mg', $from) ?>>🇲🇬 Malagasy</option>
<option value="ms" <?= isSelected('ms', $from) ?>>🇲🇾 Malay</option>
<option value="mt" <?= isSelected('mt', $from) ?>>🇲🇹 Maltese</option>
<option value="no" <?= isSelected('no', $from) ?>>🇳🇴 Norwegian</option>
<option value="ps" <?= isSelected('ps', $from) ?>>🇦🇫 Pashto</option>
<option value="fa" <?= isSelected('fa', $from) ?>>🇮🇷 Persian</option>
<option value="pl" <?= isSelected('pl', $from) ?>>🇵🇱 Polish</option>
<option value="pt" <?= isSelected('pt', $from) ?>>🇵🇹 Portuguese</option>
<option value="ro" <?= isSelected('ro', $from) ?>>🇷🇴 Romanian</option>
<option value="ru" <?= isSelected('ru', $from) ?>>🇷🇺 Russian</option>
<option value="es" <?= isSelected('es', $from) ?>>🇪🇸 Spanish</option>
<option value="th" <?= isSelected('th', $from) ?>>🇹🇭 Thai</option>
<option value="tr" <?= isSelected('tr', $from) ?>>🇹🇷 Turkish</option>
<option value="uk" <?= isSelected('uk', $from) ?>>🇺🇦 Ukrainian</option>
<option value="uz" <?= isSelected('uz', $from) ?>>🇺🇿 Uzbek</option>
<option value="vi" <?= isSelected('vi', $from) ?>>🇻🇳 Vietnamese</option>
<option value="zu" <?= isSelected('zu', $from) ?>>🇿🇦 Zulu</option>

                </select>

                <button class="swap-btn" type="button" onclick="swapLanguages()">&#8646;</button>

                <select name="to">
<option value="ur" <?= isSelected('ur', $to) ?>>🇵🇰 Urdu</option>
<option value="en" <?= isSelected('en', $to) ?>>🇬🇧 English</option>
<option value="sd" <?= isSelected('sd', $to) ?>>🇵🇰 Sindhi</option>
<option value="bn" <?= isSelected('bn', $to) ?>>🇧🇩 Bengali</option>
<option value="hi" <?= isSelected('hi', $to) ?>>🇮🇳 Hindi</option>
<option value="ne" <?= isSelected('ne', $to) ?>>🇳🇵 Nepali</option>
<option value="pa" <?= isSelected('pa', $to) ?>>🇮🇳 Punjabi</option>
<option value="ta" <?= isSelected('ta', $to) ?>>🇮🇳 Tamil</option>
<option value="te" <?= isSelected('te', $to) ?>>🇮🇳 Telugu</option>
<option value="ml" <?= isSelected('ml', $to) ?>>🇮🇳 Malayalam</option>
<option value="mr" <?= isSelected('mr', $to) ?>>🇮🇳 Marathi</option>
<option value="gu" <?= isSelected('gu', $to) ?>>🇮🇳 Gujarati</option>
<option value="kn" <?= isSelected('kn', $to) ?>>🇮🇳 Kannada</option>

<!-- Google Translate Supported Languages -->
<option value="af" <?= isSelected('af', $to) ?>>🇿🇦 Afrikaans</option>
<option value="sq" <?= isSelected('sq', $to) ?>>🇦🇱 Albanian</option>
<option value="am" <?= isSelected('am', $to) ?>>🇪🇹 Amharic</option>
<option value="ar" <?= isSelected('ar', $to) ?>>🇸🇦 Arabic</option>
<option value="hy" <?= isSelected('hy', $to) ?>>🇦🇲 Armenian</option>
<option value="az" <?= isSelected('az', $to) ?>>🇦🇿 Azerbaijani</option>
<option value="eu" <?= isSelected('eu', $to) ?>>🇪🇸 Basque</option>
<option value="be" <?= isSelected('be', $to) ?>>🇧🇾 Belarusian</option>
<option value="bs" <?= isSelected('bs', $to) ?>>🇧🇦 Bosnian</option>
<option value="bg" <?= isSelected('bg', $to) ?>>🇧🇬 Bulgarian</option>
<option value="ca" <?= isSelected('ca', $to) ?>>🇪🇸 Catalan</option>
<option value="ceb" <?= isSelected('ceb', $to) ?>>🇵🇭 Cebuano</option>
<option value="ny" <?= isSelected('ny', $to) ?>>🇲🇼 Chichewa</option>
<option value="zh" <?= isSelected('zh', $to) ?>>🇨🇳 Chinese</option>
<option value="co" <?= isSelected('co', $to) ?>>🇫🇷 Corsican</option>
<option value="hr" <?= isSelected('hr', $to) ?>>🇭🇷 Croatian</option>
<option value="cs" <?= isSelected('cs', $to) ?>>🇨🇿 Czech</option>
<option value="da" <?= isSelected('da', $to) ?>>🇩🇰 Danish</option>
<option value="nl" <?= isSelected('nl', $to) ?>>🇳🇱 Dutch</option>
<option value="eo" <?= isSelected('eo', $to) ?>>🌍 Esperanto</option>
<option value="et" <?= isSelected('et', $to) ?>>🇪🇪 Estonian</option>
<option value="tl" <?= isSelected('tl', $to) ?>>🇵🇭 Filipino</option>
<option value="fi" <?= isSelected('fi', $to) ?>>🇫🇮 Finnish</option>
<option value="fr" <?= isSelected('fr', $to) ?>>🇫🇷 French</option>
<option value="gl" <?= isSelected('gl', $to) ?>>🇪🇸 Galician</option>
<option value="ka" <?= isSelected('ka', $to) ?>>🇬🇪 Georgian</option>
<option value="de" <?= isSelected('de', $to) ?>>🇩🇪 German</option>
<option value="el" <?= isSelected('el', $to) ?>>🇬🇷 Greek</option>
<option value="ht" <?= isSelected('ht', $to) ?>>🇭🇹 Haitian Creole</option>
<option value="ha" <?= isSelected('ha', $to) ?>>🇳🇬 Hausa</option>
<option value="haw" <?= isSelected('haw', $to) ?>>🇺🇸 Hawaiian</option>
<option value="iw" <?= isSelected('iw', $to) ?>>🇮🇱 Hebrew</option>
<option value="hu" <?= isSelected('hu', $to) ?>>🇭🇺 Hungarian</option>
<option value="is" <?= isSelected('is', $to) ?>>🇮🇸 Icelandic</option>
<option value="id" <?= isSelected('id', $to) ?>>🇮🇩 Indonesian</option>
<option value="ga" <?= isSelected('ga', $to) ?>>🇮🇪 Irish</option>
<option value="it" <?= isSelected('it', $to) ?>>🇮🇹 Italian</option>
<option value="ja" <?= isSelected('ja', $to) ?>>🇯🇵 Japanese</option>
<option value="jw" <?= isSelected('jw', $to) ?>>🇮🇩 Javanese</option>
<option value="kk" <?= isSelected('kk', $to) ?>>🇰🇿 Kazakh</option>
<option value="km" <?= isSelected('km', $to) ?>>🇰🇭 Khmer</option>
<option value="ko" <?= isSelected('ko', $to) ?>>🇰🇷 Korean</option>
<option value="ku" <?= isSelected('ku', $to) ?>>🇮🇶 Kurdish</option>
<option value="ky" <?= isSelected('ky', $to) ?>>🇰🇬 Kyrgyz</option>
<option value="lo" <?= isSelected('lo', $to) ?>>🇱🇦 Lao</option>
<option value="la" <?= isSelected('la', $to) ?>>🌍 Latin</option>
<option value="lv" <?= isSelected('lv', $to) ?>>🇱🇻 Latvian</option>
<option value="lt" <?= isSelected('lt', $to) ?>>🇱🇹 Lithuanian</option>
<option value="mk" <?= isSelected('mk', $to) ?>>🇲🇰 Macedonian</option>
<option value="mg" <?= isSelected('mg', $to) ?>>🇲🇬 Malagasy</option>
<option value="ms" <?= isSelected('ms', $to) ?>>🇲🇾 Malay</option>
<option value="mt" <?= isSelected('mt', $to) ?>>🇲🇹 Maltese</option>
<option value="no" <?= isSelected('no', $to) ?>>🇳🇴 Norwegian</option>
<option value="ps" <?= isSelected('ps', $to) ?>>🇦🇫 Pashto</option>
<option value="fa" <?= isSelected('fa', $to) ?>>🇮🇷 Persian</option>
<option value="pl" <?= isSelected('pl', $to) ?>>🇵🇱 Polish</option>
<option value="pt" <?= isSelected('pt', $to) ?>>🇵🇹 Portuguese</option>
<option value="ro" <?= isSelected('ro', $to) ?>>🇷🇴 Romanian</option>
<option value="ru" <?= isSelected('ru', $to) ?>>🇷🇺 Russian</option>
<option value="es" <?= isSelected('es', $to) ?>>🇪🇸 Spanish</option>
<option value="th" <?= isSelected('th', $to) ?>>🇹🇭 Thai</option>
<option value="tr" <?= isSelected('tr', $to) ?>>🇹🇷 Turkish</option>
<option value="uk" <?= isSelected('uk', $to) ?>>🇺🇦 Ukrainian</option>
<option value="uz" <?= isSelected('uz', $to) ?>>🇺🇿 Uzbek</option>
<option value="vi" <?= isSelected('vi', $to) ?>>🇻🇳 Vietnamese</option>
<option value="zu" <?= isSelected('zu', $to) ?>>🇿🇦 Zulu</option>
                </select>
            </div>

            <input type="text" name="text" placeholder="Enter text" required value="<?= isset($_POST['text']) ? htmlspecialchars($_POST['text']) : '' ?>">
            <button type="submit">Translate</button>
        </form>
        
        <div class="output" id="translationOutput">
            <?php if (isset($result['translated_text'])): ?>
                <button class="copy-btn" onclick="copyText()">📋</button>
                <p><strong>Translation:</strong> <span id="translatedText"><?php echo htmlspecialchars($result['translated_text']); ?></span></p>
            <?php elseif (isset($response)): ?>
                <p>Error fetching translation!</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        © 2025 BJ Tricks | <a href="https://t.me/BJ_Devs" style="color: #e50914;">Learn More About Us</a>
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
