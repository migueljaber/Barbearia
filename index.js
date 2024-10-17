const el = document.querySelector("h1");
if (el) {
    const text = "ONDE TRADIÇÃO E ESTILO SE ENCONTRAM NO CORAÇÃO DE BANGU.";
    const interval = 100;

    function showText(el, text, interval) {
        const char = text.split("").reverse();
        const typer = setInterval(() => {
            if (!char.length) {
                clearInterval(typer);
                return;
            }
            const next = char.pop();
            el.innerHTML += next;
        }, interval);
    }

    showText(el, text, interval);
}