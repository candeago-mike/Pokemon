gsap.registerPlugin(TextPlugin);
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(TextPlugin);
    const dialog = document.querySelector(".text-typing-container");
    const textEl = document.querySelector("#text-typing");
    const pokemonLink = document.querySelector(".pokemon-link");
    console.log(currentPokemonName);
    let currentTween = null;

    // helper pour lancer un texte typewriter
    function playText(message, onComplete) {
        // stoppe le tween précédent s'il existe
        if (currentTween) currentTween.kill();

        currentTween = gsap.to(textEl, {
            text: { value: message },
            duration: 1.2,
            ease: "none",
            onComplete,
        });
    }

    // 2. clic sur le Pokémon -> CAPTURE ou ECHAPPE
    pokemonLink.addEventListener("click", (e) => {
        e.preventDefault();

        // retire le listener de fermeture si déjà posé
        dialog.removeEventListener("click", hideDialog);

        const success = Math.random() < 0.5; // à toi de mettre ta logique
        const msg = success
            ? "Bravo ! Tu as capturé Dracaufeu !"
            : "Oh non ! Il s'est échappé !";

        gsap.fromTo(
            dialog,
            { opacity: 0, y: 10 }, // état de départ
            {
                opacity: 1, // état d'arrivée
                y: 0,
                duration: 0.3,
                onComplete: () => {
                    dialog.style.pointerEvents = "auto"; // laisse cliquer à travers
                    playText(msg, () => {
                        dialog.addEventListener("click", hideDialog, {
                            once: true,
                        });
                    });
                },
            }
        );
    });

    // 3. fermeture du dialogue
    function hideDialog() {
        gsap.to(dialog, {
            opacity: 0,
            y: 10,
            duration: 0.3,
            onComplete: () => {
                dialog.style.pointerEvents = "none";
            },
        });
    }
});
