document.addEventListener("DOMContentLoaded", (event) => {
    gsap.registerPlugin(MorphSVGPlugin, ScrollTrigger, SplitText);

    /* MOUVEMENT POKEMON */
    gsap.to(".pokemon", {
        duration: 2,
        y: -30,
        repeat: -1, // boucle à l'infini
        yoyo: true, // fait l'aller-retour (-50 -> 0 -> -50)
        ease: "sine.inOut",
    });

    const pokeballLinks = document.querySelectorAll(".actions > a");

    let activeBall = null; // { el, rect }
    let following = false;
    let setX, setY;

    function resetBall(ball) {
        if (!ball) return;
        gsap.to(ball.el, {
            x: 0,
            y: 0,
            duration: 0.3,
            ease: "back.out",
        });
    }

    pokeballLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();

            const pokeball = link.querySelector(".pokeball");
            const pokeballBtn = link.querySelector(".pokeball-button");
            const linkRect = link.getBoundingClientRect();

            // Si on reclique sur la même pokeball et qu'elle suit déjà : on stoppe
            if (activeBall && activeBall.el === pokeball && following) {
                resetBall(activeBall);
                following = false;
                activeBall = null;
                return;
            }

            // 1. remettre la précédente en place
            resetBall(activeBall);
            following = false;

            // 2. centrer la nouvelle (point de départ)
            gsap.set([pokeball, pokeballBtn], { x: 0, y: 0 });

            // 3. définir la nouvelle active
            setX = gsap.quickSetter(pokeball, "x", "px");
            setY = gsap.quickSetter(pokeball, "y", "px");

            activeBall = { el: pokeball, rect: linkRect };
            following = true;
        });
    });

    window.addEventListener("mousemove", (e) => {
        if (!following || !activeBall) return;

        const rect = activeBall.rect;

        const offsetX = e.clientX - (rect.left + rect.width / 2);
        const offsetY = e.clientY - (rect.top + rect.height / 2);

        setX(offsetX);
        setY(offsetY);
    });

    window.addEventListener("mouseleave", () => {
        resetBall(activeBall);
        following = false;
    });

    const pokemonLink = document.querySelector(".pokemon-link");
    if (pokemonLink) {
        pokemonLink.addEventListener("click", () => {
            // la pokeball arrête de suivre et revient à sa position d'origine
            resetBall(activeBall);
            following = false;
            activeBall = null;
        });
    }
});
