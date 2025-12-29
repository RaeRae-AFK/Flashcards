<?php
$data = json_decode(file_get_contents(__DIR__ . "/cards.json"), true);
$deck = $data["decks"][0];
$cards = $deck["cards"];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($deck["name"]) ?> — Flashcards</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <main class="app">
    <header class="topbar">
      <h1 class="title"><?= htmlspecialchars($deck["name"]) ?></h1>
      <p class="subtitle">Flip the card and move through the deck.</p>
    </header>

    <section class="card-wrap">
      <div class="card" id="card">
        <div class="card-face card-front" id="front"></div>
        <div class="card-face card-back" id="back"></div>
      </div>
    </section>

    <section class="controls">
      <button class="btn" id="prev">Prev</button>
      <button class="btn primary" id="flip">Flip</button>
      <button class="btn" id="next">Next</button>
    </section>
  </main>

  <script>
    const cards = <?= json_encode($cards) ?>;
    let i = 0;
    let flipped = false;

    const cardEl = document.getElementById("card");
    const frontEl = document.getElementById("front");
    const backEl = document.getElementById("back");

    function render() {
      const c = cards[i];
      frontEl.textContent = c.front;
      backEl.textContent = c.back;
      flipped = false;
      cardEl.classList.remove("flipped");
    }

    document.getElementById("flip").onclick = () => {
      flipped = !flipped;
      cardEl.classList.toggle("flipped", flipped);
    };

    document.getElementById("next").onclick = () => {
      i = (i + 1) % cards.length;
      render();
    };

    document.getElementById("prev").onclick = () => {
      i = (i - 1 + cards.length) % cards.length;
      render();
    };

    render();


  </script>
</body>
</html>
