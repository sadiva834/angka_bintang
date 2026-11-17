<?php
$tinggi = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = trim($_POST["tinggi"] ?? "");

    // Validasi: harus bilangan bulat antara 1 sampai 20
    if ($input === "" || filter_var($input, FILTER_VALIDATE_INT) === false) {
        $error = "Masukan tidak valid! Harap masukkan bilangan bulat.";
    } else {
        $nilai = (int)$input;
        if ($nilai < 1 || $nilai > 20) {
            $error = "Masukan tidak valid! Tinggi segitiga harus antara 1 sampai 20.";
        } else {
            $tinggi = $nilai;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pola Segitiga Bintang - 4 Arah</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 960px;
        }

        .card-form {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: #38bdf8;
            margin-bottom: 8px;
        }

        p.subtitle {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        input[type="text"],
        input[type="number"] {
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #475569;
            background-color: #0f172a;
            color: #f8fafc;
            font-size: 1rem;
            width: 240px;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: #38bdf8;
        }

        button {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            background-color: #0284c7;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #0369a1;
        }

        .alert-error {
            margin-top: 18px;
            padding: 12px 16px;
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #fca5a5;
            border-radius: 8px;
            display: inline-block;
            font-weight: 500;
        }

        .grid-hasil {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 24px;
        }

        .card-pola {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
        }

        .card-pola h2 {
            font-size: 1.1rem;
            color: #f8fafc;
            border-bottom: 1px solid #334155;
            padding-bottom: 10px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge {
            font-size: 0.75rem;
            background-color: #0f172a;
            color: #38bdf8;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #334155;
        }

        .canvas-bintang {
            background-color: #0f172a;
            border-radius: 8px;
            padding: 20px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: auto;
            min-height: 220px;
        }

        pre {
            font-family: 'Courier New', Courier, monospace;
            font-size: 16px;
            line-height: 1.25;
            color: #facc15;
            letter-spacing: 2px;
            margin: 0;
        }

        @media (max-width: 480px) {
            .grid-hasil {
                grid-template-columns: 1fr;
            }
            pre {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Form Input -->
    <div class="card-form">
        <h1>Generator Segitiga Bintang 4 Arah</h1>
        <p class="subtitle">Masukkan tinggi segitiga (bilangan bulat 1 - 20)</p>

        <form method="POST" action="">
            <div class="form-group">
                <input 
                    type="text" 
                    name="tinggi" 
                    placeholder="Contoh: 5" 
                    value="<?= htmlspecialchars($_POST['tinggi'] ?? '') ?>"
                    autocomplete="off"
                >
                <button type="submit">Tampilkan Pola</button>
            </div>
        </form>

        <?php if ($error !== ""): ?>
            <div class="alert-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Hasil Pola Bintang -->
    <?php if ($tinggi !== null): ?>
        <div class="grid-hasil">

            <!-- 1. SEGITIGA ARAH KE ATAS -->
            <div class="card-pola">
                <h2>Segitiga Arah Ke Atas <span class="badge">Tinggi: <?= $tinggi ?></span></h2>
                <div class="canvas-bintang">
<pre><?php
for ($i = 1; $i <= $tinggi; $i++) {
    // Cetak spasi agar posisi simetris di tengah
    for ($s = 1; $s <= ($tinggi - $i); $s++) {
        echo " ";
    }
    // Cetak bintang
    for ($b = 1; $b <= (2 * $i - 1); $b++) {
        echo "*";
    }
    echo "\n";
}
?></pre>
                </div>
            </div>

            <!-- 2. SEGITIGA ARAH KE BAWAH -->
            <div class="card-pola">
                <h2>Segitiga Arah Ke Bawah <span class="badge">Tinggi: <?= $tinggi ?></span></h2>
                <div class="canvas-bintang">
<pre><?php
for ($i = $tinggi; $i >= 1; $i--) {
    // Cetak spasi di kiri
    for ($s = 1; $s <= ($tinggi - $i); $s++) {
        echo " ";
    }
    // Cetak bintang
    for ($b = 1; $b <= (2 * $i - 1); $b++) {
        echo "*";
    }
    echo "\n";
}
?></pre>
                </div>
            </div>

            <!-- 3. SEGITIGA ARAH KE KANAN -->
            <div class="card-pola">
                <h2>Segitiga Arah Ke Kanan <span class="badge">Puncak: <?= $tinggi ?></span></h2>
                <div class="canvas-bintang">
<pre><?php
// Bagian atas hingga puncak
for ($i = 1; $i <= $tinggi; $i++) {
    for ($b = 1; $b <= $i; $b++) {
        echo "*";
    }
    echo "\n";
}
// Bagian bawah setelah puncak
for ($i = $tinggi - 1; $i >= 1; $i--) {
    for ($b = 1; $b <= $i; $b++) {
        echo "*";
    }
    echo "\n";
}
?></pre>
                </div>
            </div>

            <!-- 4. SEGITIGA ARAH KE KIRI -->
            <div class="card-pola">
                <h2>Segitiga Arah Ke Kiri <span class="badge">Puncak: <?= $tinggi ?></span></h2>
                <div class="canvas-bintang">
<pre><?php
// Bagian atas hingga puncak
for ($i = 1; $i <= $tinggi; $i++) {
    for ($s = 1; $s <= ($tinggi - $i); $s++) {
        echo " ";
    }
    for ($b = 1; $b <= $i; $b++) {
        echo "*";
    }
    echo "\n";
}
// Bagian bawah setelah puncak
for ($i = $tinggi - 1; $i >= 1; $i--) {
    for ($s = 1; $s <= ($tinggi - $i); $s++) {
        echo " ";
    }
    for ($b = 1; $b <= $i; $b++) {
        echo "*";
    }
    echo "\n";
}
?></pre>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>

</body>
</html>