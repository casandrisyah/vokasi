<style>
    @import url('https://fonts.googleapis.com/css?family=Lato');

    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        font-size: 16px;
        /* font-family: 'Lato', sans-serif; */
    }

    .timeline {
        color: #fff;
    }

    .timeline h1,
    .timeline ul li .content h2 {
        font-weight: 600;
        /* text-shadow: 1px 1px 1px rgba(56, 56, 56, 0.5); */
    }

    .timeline h1 {
        background: #003966;
        padding: 70px 0;
        font-size: 2.5em;
        text-align: center;
    }

    .timeline ul {
        /* background: #faf8eb; */
        padding: 50px 0;
    }

    .timeline ul li {
        background: #003966;
        position: relative;
        margin: 0 auto;
        width: 5px;
        min-height: 200px;
        margin-bottom: -90px;
        list-style-type: none;
    }

    .timeline ul li:last-child {
        padding-bottom: 0px;
        /* margin-bottom: 40px; */
    }

    .timeline ul li:before {
        content: '';
        background: #faf8eb;
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
        width: 20px;
        height: 20px;
        border: 3px solid #003966;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .timeline ul li .hidden {
        opacity: 0;
    }

    .timeline ul li .content {
        /* background: #003966; */
        position: relative;
        top: 7px;
        width: 42vw;
        padding: 20px;
    }

    .timeline ul li .content h2 {
        color: black;
        margin-top: 10px;
        margin-bottom: 0 !important;
        padding-bottom: 5px !important;
        /* text-align: left; */
    }

    .timeline ul li .content p {
        /* text-align: center; */
        color: black !important;
    }

    .timeline ul li .content p:nth-child(2) {
        margin-bottom: 0;
    }

    .timeline ul li .content:before {
        content: '';
        background: #003966;
        position: absolute;
        top: 0px;
        width: 43.5vw;
        height: 5px;
    }

    .timeline ul li:nth-child(even) .content {
        left: 30px;
        /* background: #003966; */
    }

    .timeline ul li:nth-child(even) .content:before {
        left: -18px;
    }

    .timeline ul li:nth-child(odd) .content {
        /* border-radius: 10px 0 10px 10px; */
        left: calc(-42vw - 48px);
        /* background: #003966; */
    }

    .timeline ul li:nth-child(odd) .content:before {
        right: -43px;
    }

    /* ------------------------- ----- Media Queries ----- ------------------------- */
    @media screen and (max-width: 1020px) {
        .timeline ul li .content {
            width: 350px;
        }

        .timeline ul li:nth-child(odd) .content {
            left: calc(-350px - 50px);
        }
    }

    @media screen and (max-width: 900px) {
        .timeline ul li .content {
            width: 300px;
        }

        .timeline ul li:nth-child(odd) .content {
            left: calc(-300px - 50px);
        }
    }

    @media screen and (max-width: 800px) {
        .timeline ul li .content {
            width: 250px;
        }

        .timeline ul li:nth-child(odd) .content {
            left: calc(-250px - 50px);
        }
    }

    @media screen and (max-width: 700px) {
        .timeline ul li .content {
            width: 200px;
        }

        .timeline ul li:nth-child(odd) .content {
            left: calc(-200px - 45px);
        }
    }

    @media screen and (max-width: 768px) {
        .timeline ul li {
            width: auto;
            background: transparent;
            margin-bottom: 0;
        }

        .timeline ul li:before {
            display: none;
        }

        .timeline ul li .content {
            position: static;
            width: auto;
            padding: 20px;
            margin-bottom: -20px;
        }

        .timeline ul li .content:before {
            display: none;
        }

        .timeline ul li:nth-child(even) .content,
        .timeline ul li:nth-child(odd) .content {
            left: auto;
        }
    }
</style>
