@echo off
SET extensions=bmewburn.vscode-intelephense-client dbaeumer.vscode-eslint felixfbecker.php-intellisense formulahendry.auto-close-tag formulahendry.auto-rename-tag formulahendry.code-runner humao.rest-client kumar-harsh.graphql-for-vscode ms-azuretools.vscode-docker ms-python.python golang.go octref.vetur coenraads.bracket-pair-colorizer ritwickdey.live-sass ritwickdey.liveserver rebornix.ruby redhat.java esbenp.prettier-vscode gabrielbb.vscode-lombok ecmel.vscode-html-css streetsidesoftware.code-spell-checker eamodio.gitlens yzhang.markdown-all-in-one auchenberg.vscode-browser-preview xabikos.javascriptsnippets

FOR %%G IN (%extensions%) DO ( 
    code --install-extension %%G
)

set program=php composer nodejs golang python ruby jdk8 jre8 lua vlc paint.net gimp mkcert
FOR %%G IN (%extensions%) DO ( 
    choco install %%G
)

gem install solargraph

$Env:ChocolateyToolsLocation = "d:\tools"
choco install php --package-parameters='/InstallDir:d:\tools\php' -y
choco install composer --params '"/Dev:d:\tools\composer /Php:d:\tools\php"' -y
choco install golang -y
choco install ruby -y
choco install python3 --version=3.8.6 --params "/InstallDir:d:\tools\python3" -y
choco install nodejs-lts --version=12.19.0 -ia "'INSTALLDIR=d:\tools\nodejs'" -y
choco install jdk8 -params 'installdir=d:\\tools\\java8' -y
choco install mkcert -y
choco install yarn -y
choco install cygwin --params "/InstallDir:d:\tools\cygwin /NoStartMenu" -y
choco install git -y

cd c:\cygwin
cygwinsetup.exe -q -P wget,tar,qawk, bzip2,vim,lynx,jq