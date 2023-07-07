function stt() {
    var inputField = document.getElementById('transcript');
    if (inputField) {
        var inputValue = inputField.value;
        // remove shad and tsek at the begining of the string
        var modifiedValue = inputValue.replace(/^( |་|།)/, '').trim();

        // remove yang at beginings
        modifiedValue = modifiedValue.replace(/^[ིེོུ]/, '');

        //
        modifiedValue = modifiedValue.replace(
            /^(འི་|ས་|གོ |ངོ་།|དོ།|ནོ།|འོ།|རོ།|སོ།|ཏོ།|ས།|ངས།|༄༅།།|༌།|ར།|ང༌། |ད།|ག |ན།|བ།|མ།|འ།|ར།|ལ།|ས།|རེད།|ཏེ།)/,
            ''
        );

        // modifiedValue = modifiedValue.replace(/.*།(?!.*།)/, '');

        modifiedValue = modifiedValue.replace(/ང།/g, 'ང་།');
        modifiedValue = modifiedValue.replace(/། །/g, '།། ');
        // add spaces after shay unless there are two shay together
        modifiedValue = modifiedValue.replace(/(?<!།)།(?!།)/g, '། ');
        // remove extra tsek
        modifiedValue = modifiedValue.replace(/་+/g, '་');
        // remove space before and after a tsek
        modifiedValue = modifiedValue.replace(/་ /g, '་');
        modifiedValue = modifiedValue.replace(/ ་/g, '་');
        modifiedValue = modifiedValue.replace(/ཡོད་པར་མ་ཟད/g, 'ཡོད་པ་མ་ཟད');

        // remove extraspaces
        modifiedValue = modifiedValue.replace(/ +/g, ' ');

        // add missing yang for lardu
        modifiedValue = modifiedValue.replace(/ང་ང$/, 'ང་ངོ');
        modifiedValue = modifiedValue.replace(/ད་ད$/, 'ད་དོ');
        modifiedValue = modifiedValue.replace(/ར་ར$/, 'ར་རོ');
        modifiedValue = modifiedValue.replace(/ན་ན$/, 'ན་ནོ');
        modifiedValue = modifiedValue.replace(/ས་ས$/, 'ས་སོ');
        modifiedValue = modifiedValue.replace(/ག་ག$/, 'ག་གོ');
        modifiedValue = modifiedValue.replace(/ལ་ལ$/, 'ལ་ལོ');

        if (modifiedValue.endsWith('ང་')) {
            modifiedValue += '།';
        } else if (modifiedValue.endsWith('ང')) {
            modifiedValue += '་།';
        } else if (modifiedValue.endsWith('་')) {
            modifiedValue = modifiedValue.replace(/་$/, '།');
        }
        // remove space at end
        if (modifiedValue.endsWith(' ')) {
            modifiedValue = modifiedValue.replace(/ $/, '');
        }
        // add tsek and shey after ངོ
        modifiedValue = modifiedValue.replace(/ངོ$/, 'ངོ་།།');
        modifiedValue = modifiedValue.replace(/ནོ$/, 'ནོ།།');
        modifiedValue = modifiedValue.replace(/དོ$/, 'དོ།།');
        modifiedValue = modifiedValue.replace(/འོ$/, 'འོ།།');
        modifiedValue = modifiedValue.replace(/སོ$/, 'སོ།།');
        modifiedValue = modifiedValue.replace(/ཏོ$/, 'ཏོ།།');
        modifiedValue = modifiedValue.replace(/རོ$/, 'རོ།།');
        modifiedValue = modifiedValue.replace(/ལ་ལོ$/, 'ལ་ལོ།།');

        // add shek at the end
        if (
            !modifiedValue.endsWith('།') &&
            !modifiedValue.endsWith('ག') &&
            !modifiedValue.endsWith('གི')
        ) {
            modifiedValue += '།';
        }

        var nativeInputValueSetter = Object.getOwnPropertyDescriptor(
            window.HTMLTextAreaElement.prototype,
            'value'
        ).set;
        nativeInputValueSetter.call(inputField, modifiedValue);

        var ev2 = new Event('input', { bubbles: true });
        inputField.dispatchEvent(ev2);
    }
}
var playButton = document.getElementsByClassName('c01156');

var parentElement = document.querySelector('.prodigy-buttons');
// Create a new button element
var sttbutton = document.createElement('button');
sttbutton.textContent = 'Click Me';
// Assign the class name 'btn'
sttbutton.className = 'prodigy-button-correct c01120 c01123 ';

// execute script upon click and play audio
sttbutton.addEventListener('click', () => {
    stt();
    playButton[0].click();
});

// create new accept button

var acceptBtn = document.createElement('button');
acceptBtn.className = 'c01120 c01123';
parentElement.appendChild(acceptBtn);

acceptBtn.addEventListener('click', () => {
    document.getElementsByClassName('prodigy-button-accept')[0].click();
});

// Append the button to the parent element
parentElement.appendChild(sttbutton);
