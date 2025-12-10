document.addEventListener("DOMContentLoaded", () => {
    console.log("text-typing.js chargé");

    gsap.registerPlugin(TextPlugin);

    const dialog = document.querySelector(".text-typing-container");
    const textEl = document.querySelector("#text-typing");
    const pokemonLink = document.querySelector(".pokemon-link");

    if (!dialog || !textEl || !pokemonLink) return;

    let currentTween = null;

    function playText(message, onComplete) {
        if (currentTween) currentTween.kill();

        currentTween = gsap.to(textEl, {
            text: { value: message },
            duration: 1.2,
            ease: "none",
            onComplete,
        });
    }

    // // 2. clic sur le Pokémon -> CAPTURE ou ECHAPPE
    // pokemonLink.addEventListener("click", (e) => {
    //     e.preventDefault();

    //     // retire le listener de fermeture si déjà posé
    //     dialog.removeEventListener("click", hideDialog);

    //     const success = Math.random() < 0.5; // à toi de mettre ta logique
    //     const msg = success
    //         ? "Bravo ! Tu as capturé Dracaufeu !"
    //         : "Oh non ! Il s'est échappé !";

    //     gsap.fromTo(
    //         dialog,
    //         { opacity: 0, y: 10 }, // état de départ
    //         {
    //             opacity: 1, // état d'arrivée
    //             y: 0,
    //             duration: 0.3,
    //             onComplete: () => {
    //                 dialog.style.pointerEvents = "auto"; // laisse cliquer à travers
    //                 playText(msg, () => {
    //                     dialog.addEventListener("click", hideDialog, {
    //                         once: true,
    //                     });
    //                 });
    //             },
    //         }
    //     );
    // });

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

    // 1. Nouveau Pokémon apparu
    window.addEventListener("pokemon-updated", (event) => {
        const name = event.detail?.name;
        console.log("pokemon-updated", event.detail);

        if (!name) return;

        gsap.from(dialog, {
            opacity: 0,
            y: 10,
            duration: 0.3,
            onComplete: () => {
                dialog.style.pointerEvents = "auto";
                playText(`${name} est apparu...`, () => {
                    dialog.addEventListener("click", hideDialog, {
                        once: true,
                    });
                });
            },
        });
    });

    // 2. Résultat capture (succès / échec)
    window.addEventListener("message-updated", (event) => {
        console.log("message-updated reçu", event.detail);

        const msg = event.detail?.text;
        if (!msg) return;

        gsap.fromTo(
            dialog,
            { opacity: 0, y: 10 },
            {
                opacity: 1,
                y: 0,
                duration: 0.3,
                onComplete: () => {
                    dialog.style.pointerEvents = "auto";
                    playText(msg, () => {
                        dialog.addEventListener(
                            "click",
                            () => {
                                hideDialog();
                                Livewire.dispatch("animation-finished");
                            },
                            { once: true }
                        );
                    });
                },
            }
        );
    });

    // 3. Clic sur le Pokémon : juste empêcher la nav
    pokemonLink.addEventListener("click", (e) => {
        e.preventDefault(); // Livewire gère wire:click.prevent="capture"
    });
});
