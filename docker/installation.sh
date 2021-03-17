for extension in bmewburn.vscode-intelephense-client dbaeumer.vscode-eslint felixfbecker.php-intellisense formulahendry.auto-close-tag \
                formulahendry.auto-rename-tag formulahendry.code-runner humao.rest-client kumar-harsh.graphql-for-vscode ms-azuretools.vscode-docker \
                ms-python.python golang.go octref.vetur coenraads.bracket-pair-colorizer ritwickdey.live-sass ritwickdey.liveserver \
                rebornix.ruby redhat.java esbenp.prettier-vscode gabrielbb.vscode-lombok ecmel.vscode-html-css streetsidesoftware.code-spell-checker eamodio.gitlens \
                vscjava.vscode-java-pack gruntfuggly.todo-tree oderwat.indent-rainbow TabNine.tabnine-vscode castwide.solargraph \
                yzhang.markdown-all-in-one auchenberg.vscode-browser-preview xabikos.javascriptsnippets; do code-server --install-extension $extension; done


go get -u github.com/astaxie/beego github.com/beego/bee github.com/gin-gonic/gin golang.org/x/tools/cmd/goimports \
                               github.com/ramya-rao-a/go-outline github.com/stamblerre/gocode github.com/uudashr/gopkgs/v2/cmd/gopkgs \
                               github.com/rogpeppe/godef golang.org/x/tools/gopls github.com/sqs/goreturns


git config --global user.email "you@example.com"
git config --global user.name "Your Name"