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

function hexToBase64(str) {
  return btoa(
    String.fromCharCode.apply(
      null,
      str
        .replace(/\r|\n/g, '')
        .replace(/([\da-fA-F]{2}) ?/g, '0x$1 ')
        .replace(/ +$/, '')
        .split(' ')
    )
  );
}

const actionHandler = (e, item, callback) => {
  let loading = document.createElement('div');
  loading.classList = 'lds-dual-ring';
  let result = e.target.closest('pre').querySelector('.md-result');
  result.classList = 'md-result';
  result.innerHTML = '';

  let languageType = 'unknown type';
  let codeContext = null;

  result.appendChild(loading, item.target);
  let multipleFiles = e.target.closest('li > .tabbed-set');
  if (multipleFiles) {
    let labels = Array.from(multipleFiles.querySelectorAll('label')).map((item) => item.innerText);
    let contents = Array.from(multipleFiles.querySelectorAll('code')).map((item, key) => {
      if (key === 0) {
        let filtered = Array.from(item.classList).filter((i) => i.indexOf('language') !== -1);
        if (filtered.length > 0) {
          languageType = filtered[0].replace('language-', '');
        }
      }
      return item.innerText;
    });

    codeContext = labels.map((label, key) => {
      return { filename: label, content: contents[key] };
    });
  } else {
    let target = e.target.closest('span[class*="twemoji"]').dataset.apiTarget;
    let code = document.querySelector(target);
    let filtered = Array.from(code.classList).filter((i) => i.indexOf('language') !== -1);
    if (filtered.length > 0) {
      languageType = filtered[0].replace('language-', '');
    }
    codeContext = code.innerText;
  }
  let actionType = e.target.closest('span[class*="twemoji"]').dataset.type;
  callback(JSON.stringify({ type: languageType, code: codeContext, action: actionType }), result);
};

const runDownload = () => {
  let codes = document.querySelectorAll('pre code');
  Array.from(codes)
    .forEach((item, key) => {
      let resultDiv = document.createElement('div');
      resultDiv.classList = 'md-result middle';
      item.parentElement.insertBefore(resultDiv, item.nextSibling);

      let download = document.createElement('span');
      download.classList = 'twemoji md-download';
      download.title = 'Download';
      download.dataset.type = 'download';
      download.innerHTML =
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 6a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.11.89-2 2-2h6l2 2h8m-.75 7H16V9h-2v4h-3.25L15 17.25"></path></svg>';
      download.dataset.apiTarget = `#__code_${key} > code`;
      item.parentElement.insertBefore(download, item);
      download.addEventListener('click', (e) => {
        actionHandler(e, item, function (body, result) {
          fetch(window.location.protocol + "//" + window.location.hostname + ':5000', {
            method: 'post',
            headers: {
              'Content-Type': 'application/json;charset=UTF-8',
            },
            body: body,
          })
            .then((data) => data.blob())
            .then((data) => {
              // https://stackoverflow.com/questions/32545632/how-can-i-download-a-file-using-window-fetch
              let file = window.URL.createObjectURL(data);
              window.location.assign(file);
              result.innerHTML = '';
            })
            .catch((e) => {
              console.log(e);
            });
        });
      });
    });
};

const runApi = () => {
  let codes = document.querySelectorAll('pre code');
  Array.from(codes)
    .filter((item) => !item.dataset.play)
    .forEach((item, key) => {
      let resultDiv = document.createElement('div');
      resultDiv.classList = 'md-result';
      item.parentElement.insertBefore(resultDiv, item.nextSibling);

      let button = document.createElement('span');
      button.classList = 'twemoji md-play';
      button.title = 'Run';
      button.dataset.type = 'run';
      button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8 5.14v14l11-7-11-7z"></path></svg>';
      button.dataset.apiTarget = `#${item.parentElement.id} > code`;
      item.parentElement.insertBefore(button, item);
      button.addEventListener('click', (e) => {
        actionHandler(e, item, function (body, result) {
          fetch(window.location.protocol + "//" + window.location.hostname + ':5000', {
            method: 'post',
            headers: {
              'Content-Type': 'application/json;charset=UTF-8',
            },
            body: body,
          })
            .then((data) => data.json())
            .then((data) => {
              resultDiv.classList = 'md-result';
              if (data.mimeType && data.mimeType.startsWith('image')) {
                let img = document.createElement('img');
                img.src = data.msg;
                result.innerHTML = '';
                result.appendChild(img);
              } else if (data.mimeType && data.mimeType == "application/json") {
                fetch(data.msg).then(res => res.json()).then(data => {
                  result.innerHTML = JSON.stringify(data, null, 2);
                })
              } else if (data.mimeType && data.mimeType == "application/x-empty") {
                result.innerHTML = "";
              } else if (data.mimeType && data.mimeType == "text/html") {
                fetch(data.msg).then(res => res.text()).then(data => {
                  result.innerHTML = data;
                })
              }
              else {
                result.innerHTML = data.msg;
              }
            })
            .catch((e) => {
              console.log(e);
            });
        });
      });
    });
}

window.onload = function () {
  runApi();
  runDownload();
  copyInlineCode();
};
