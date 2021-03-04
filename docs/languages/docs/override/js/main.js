hljs.initHighlighting();

const getMethods = (obj) => {
  let properties = new Set();
  let currentObj = obj;
  do {
    Object.getOwnPropertyNames(currentObj).map((item) => properties.add(item));
  } while ((currentObj = Object.getPrototypeOf(currentObj)));
  return [...properties.keys()].filter((item) => typeof obj[item] === 'function');
};

const copyToClipboard = (str) => {
  const el = document.createElement('textarea');
  el.value = str;
  el.setAttribute('readonly', '');
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
};

const showDialog = (str) => {
  let dialog = document.querySelector('.md-dialog');
  dialog.dataset.mdState = 'open';
  dialog.querySelector('.md-dialog__inner.md-typeset').innerHTML = str;
  setTimeout(() => {
    dialog.dataset.mdState = null;
  }, 1500);
};

const selectElement = (node) => {
  if (document.body.createTextRange) {
    const range = document.body.createTextRange();
    range.moveToElementText(node);
    range.select();
  } else if (window.getSelection) {
    const selection = window.getSelection();
    const range = document.createRange();
    range.selectNodeContents(node);
    selection.removeAllRanges();
    selection.addRange(range);
    showDialog('Copied to clipboard');
  } else {
    console.warn('Could not select text in node: Unsupported browser.');
  }
};
const copyInlineCode = () => {
  let codes = document.querySelectorAll('code:not([class])');
  Array.from(codes).forEach((item) => {
    // <button class="md-clipboard md-icon" title="Copy to clipboard" data-clipboard-target="#__code_0 > code"></button>
    let button = document.createElement('button');
    button.classList = 'md-clipboard md-icon md-code';
    button.title = 'Copy to clipboard';
    item.before(button);
    button.addEventListener('click', (e) => {
      let text = e.target.nextSibling.innerText.replace(/^\s*\$/, '');
      copyToClipboard(text);
      selectElement(e.target.nextSibling);
    });
  });
};

const runApi = () => {
  let codes = document.querySelectorAll('pre code');
  Array.from(codes)
    .filter((item) => !item.dataset.play)
    .forEach((item, key) => {
      let resultDiv = document.createElement('div');
      resultDiv.classList = 'md-result middle';
      item.parentElement.insertBefore(resultDiv, item.nextSibling);

      let button = document.createElement('span');
      button.classList = 'twemoji md-play';
      button.title = 'Run';
      button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8 5.14v14l11-7-11-7z"></path></svg>';
      button.dataset.apiTarget = `#__code_${key} > code`;
      item.parentElement.insertBefore(button, item);
      button.addEventListener('click', (e) => {
        let loading = document.createElement('div');
        loading.classList = 'lds-dual-ring';
        let result = e.target.closest('.tabbed-content').querySelector('.md-result');
        result.classList = 'md-result middle';
        result.innerHTML = '';
        result.appendChild(loading, item.target);
        let target = e.target.closest('.md-play').dataset.apiTarget;
        let code = document.querySelector(target);
        if (code.closest('.tabbed-content')) {
          let languageType = 'unknown type';
          let filtered = Array.from(code.classList).filter((i) => i.indexOf('language') !== -1);
          if (filtered.length > 0) {
            languageType = filtered[0].replace('language-', '');
          }
          console.log();
          fetch('http://localhost:5000', {
            method: 'post',
            headers: {
              'Content-Type': 'application/json;charset=UTF-8',
            },
            body: JSON.stringify({ type: languageType, code: code.innerText }),
          })
            .then((data) => data.json())
            .then((data) => {
              resultDiv.classList = 'md-result';
              result.innerHTML = data.msg;
            })
            .catch((e) => {
              console.log(e);
            });
        }
      });
    });
};
window.onload = function () {
  runApi();
  copyInlineCode();
};
