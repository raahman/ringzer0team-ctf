Utilizzo di un tool per il reverse-hash

sito: https://hashtoolkit.com/reverse-hash

il reverse hash da effettuare è : b89356ff6151527e89c4f3e3d30c8e6586c63962

if(Sha1.hash(p) == "b89356ff6151527e89c4f3e3d30c8e6586c63962") {
    if(document.location.href.indexOf("?p=") == -1) {
        document.location = document.location.href + "?p=" + p;
    }
}
