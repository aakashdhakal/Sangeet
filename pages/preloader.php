<div class="preloader">
    <div class="preloader__logo">
        <img src="public/images/logo-circle.png" alt="logo">
    </div>
    <div class="loader"></div>
    <div class="random-quote">
        <p>“Music is the universal language of mankind.”</p>
        <p> - Henry Wadsworth Longfellow</p>
    </div>

</div>
<style>
    img {
        width: 8%;
    }

    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--bg-color);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
        flex-direction: column;
    }

    .preloader__logo {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* HTML: <div class="loader"></div> */
    .loader {
        width: 50px;
        aspect-ratio: 2;
        --_g: no-repeat radial-gradient(circle closest-side, var(--primary-color) 90%, #0000);
        background:
            var(--_g) 0% 50%,
            var(--_g) 50% 50%,
            var(--_g) 100% 50%;
        background-size: calc(100%/3) 50%;
        animation: l3 1s infinite linear;
    }

    @keyframes l3 {
        20% {
            background-position: 0% 0%, 50% 50%, 100% 50%
        }

        40% {
            background-position: 0% 100%, 50% 0%, 100% 50%
        }

        60% {
            background-position: 0% 50%, 50% 100%, 100% 0%
        }

        80% {
            background-position: 0% 50%, 50% 50%, 100% 100%
        }
    }

    .random-quote {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        flex-direction: column;
        position: absolute;
        bottom: 3vh;
        left: 0;
        width: 100%;
    }
</style>