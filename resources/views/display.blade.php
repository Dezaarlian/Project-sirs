<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <title>Layar Antrean — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0a0f1e;
            --surface: #0f1628;
            --surface2: #151d35;
            --border: rgba(99,102,241,0.2);
            --blue: #3b82f6;
            --indigo: #6366f1;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #475569;
            --success: #22c55e;
            --warning: #f59e0b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            overflow: hidden;
        }

        /* ─── Layout ─── */
        .layout {
            display: grid;
            grid-template-rows: auto 1fr;
            min-height: 100vh;
        }

        /* ─── Header ─── */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 2.5rem;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }
        .header-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .header-logo {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .header-logo svg { width: 24px; height: 24px; color: white; fill: none; stroke: white; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .header-title { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.02em; }
        .header-subtitle { font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.1rem; }
        .header-clock {
            text-align: right;
        }
        .header-time { font-size: 2rem; font-weight: 800; font-variant-numeric: tabular-nums; letter-spacing: -0.02em; }
        .header-date { font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.1rem; }
        .header-stats {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .stat-item { text-align: center; }
        .stat-num { font-size: 1.75rem; font-weight: 900; line-height: 1; }
        .stat-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin-top: 0.2rem; }

        /* ─── Main Content ─── */
        .content {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 0;
            overflow: hidden;
        }

        /* ─── NOW SERVING ─── */
        .now-serving-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            flex: 1;
        }
        .now-serving-container::before {
            content: '';
            position: absolute;
            top: -200px; left: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        .active-calls-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            width: 100%;
            justify-content: center;
            align-items: stretch;
        }
        .now-serving {
            flex: 1;
            min-width: 250px;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(15, 22, 40, 0.6);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem 1.5rem;
            position: relative;
        }
        .now-serving-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }
        .pulse-dot {
            width: 10px; height: 10px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse-anim 1.5s ease-in-out infinite;
        }
        @keyframes pulse-anim {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }
        .ticket-number {
            font-size: clamp(4rem, 12vw, 8rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1;
            background: linear-gradient(135deg, #fff 0%, #93c5fd 50%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .ticket-empty {
            font-size: 4rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: var(--text-muted);
        }
        .patient-info {
            text-align: center;
            max-width: 500px;
        }
        .patient-name {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        .patient-poli {
            font-size: 1rem;
            color: var(--blue);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        .patient-doctor {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(245,158,11,0.15);
            border: 1.5px solid rgba(245,158,11,0.4);
            color: #fbbf24;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.5rem 1.25rem;
            border-radius: 100px;
            margin-top: 1.5rem;
            animation: badge-glow 2s ease-in-out infinite;
        }
        @keyframes badge-glow {
            0%, 100% { box-shadow: 0 0 0 rgba(245,158,11,0); }
            50% { box-shadow: 0 0 20px rgba(245,158,11,0.2); }
        }
        .no-call-text {
            font-size: 1.125rem;
            color: var(--text-muted);
            text-align: center;
            max-width: 320px;
        }

        /* ─── Queue Sidebar ─── */
        .queue-sidebar {
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .sidebar-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-secondary);
        }
        .queue-list {
            flex: 1;
            overflow: hidden;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .queue-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 0.9rem 1.1rem;
            transition: all 0.2s;
        }
        .queue-item:first-child {
            border-color: rgba(59,130,246,0.4);
            background: rgba(59,130,246,0.05);
        }
        .queue-rank {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: rgba(99,102,241,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
            font-weight: 800;
            color: var(--indigo);
            flex-shrink: 0;
        }
        .queue-item:first-child .queue-rank {
            background: var(--blue);
            color: white;
        }
        .queue-num {
            font-size: 1.35rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            line-height: 1;
        }
        .queue-poli {
            font-size: 0.7rem;
            color: var(--text-secondary);
            margin-top: 0.15rem;
        }
        .queue-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 0.875rem;
            gap: 0.5rem;
        }

        /* ─── Footer Ticker ─── */
        .ticker {
            grid-column: 1 / -1;
            background: var(--surface2);
            border-top: 1px solid var(--border);
            padding: 0.625rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            overflow: hidden;
        }
        .ticker-label {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--blue);
            white-space: nowrap;
            padding: 0.25rem 0.75rem;
            background: rgba(59,130,246,0.15);
            border-radius: 4px;
            flex-shrink: 0;
        }
        .ticker-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
            white-space: nowrap;
            animation: marquee 30s linear infinite;
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-100%); }
        }
    </style>
</head>
<body>
    <div class="layout">
        {{-- ── Header ── --}}
        <div class="header">
            <div class="header-brand">
                <div class="header-logo">
                    <svg viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <div class="header-title">{{ config('app.name', 'RS Pro') }}</div>
                    <div class="header-subtitle">Sistem Informasi Antrean Pasien</div>
                </div>
            </div>

            <div class="header-stats">
                <div class="stat-item">
                    <div class="stat-num" style="color: #3b82f6;">{{ $totalHariIni }}</div>
                    <div class="stat-label">Total Hari Ini</div>
                </div>
                <div style="width:1px; height:40px; background: rgba(99,102,241,0.2);"></div>
                <div class="stat-item">
                    <div class="stat-num" style="color: #22c55e;">{{ $totalSelesai }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
                <div style="width:1px; height:40px; background: rgba(99,102,241,0.2);"></div>
                <div class="stat-item">
                    <div class="stat-num" style="color: #f59e0b;">{{ $antreanSelanjutnya->count() }}</div>
                    <div class="stat-label">Menunggu</div>
                </div>
            </div>

            <div class="header-clock">
                <div class="header-time">{{ \Carbon\Carbon::now()->format('H:i:s') }}</div>
                <div class="header-date">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
            </div>
        </div>

        {{-- ── Main Content ── --}}
        <div class="content">

            {{-- Now Serving --}}
            <div class="now-serving-container">
                @if($panggilanAktif->isNotEmpty())
                    <div class="active-calls-grid">
                        @foreach($panggilanAktif as $aktif)
                        <div class="now-serving">
                            <div class="now-serving-label">
                                <div class="pulse-dot"></div>
                                {{ $aktif->jadwal->poliklinik->nama_poli }}
                            </div>
                            <div class="ticket-number">{{ $aktif->nomor_urut }}</div>
                            <div class="patient-info">
                                <div class="patient-name" style="font-size: 1.5rem;">{{ $aktif->user->name }}</div>
                                <div class="patient-doctor">{{ $aktif->jadwal->nama_dokter }}</div>
                                <div class="status-badge" style="margin-top: 1rem; padding: 0.35rem 1rem; font-size: 0.7rem;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                    Silakan Masuk
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; margin: auto;">
                        <div style="font-size: 5rem; margin-bottom: 1.5rem; opacity: 0.2;">🔔</div>
                        <div class="ticket-empty">—</div>
                        <div class="no-call-text" style="margin-top: 1.5rem;">
                            Belum ada pasien yang dipanggil.<br>
                            Harap menunggu dengan tertib.
                        </div>
                    </div>
                @endif
            </div>

            {{-- Queue Sidebar --}}
            <div class="queue-sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-title">⏳ Antrean Berikutnya</div>
                </div>
                <div class="queue-list">
                    @if($antreanSelanjutnya->isEmpty())
                        <div class="queue-empty">
                            <span style="font-size: 2rem; opacity: 0.3;">✓</span>
                            <span>Tidak ada antrean berikutnya</span>
                        </div>
                    @else
                        @foreach($antreanSelanjutnya as $i => $antrean)
                            <div class="queue-item">
                                <div class="queue-rank">{{ $i + 1 }}</div>
                                <div style="flex: 1; min-width: 0;">
                                    <div class="queue-num">{{ $antrean->nomor_urut }}</div>
                                    <div class="queue-poli">{{ $antrean->jadwal->poliklinik->nama_poli }}</div>
                                </div>
                                @if($i === 0)
                                    <div style="font-size: 0.65rem; background: rgba(59,130,246,0.15); color: #60a5fa; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 700; white-space: nowrap;">SELANJUTNYA</div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- ── Footer Ticker ── --}}
        <div class="ticker">
            <div class="ticker-label">INFO</div>
            <div class="ticker-text">
                Harap siapkan kartu identitas (KTP/SIM) dan kartu BPJS/Asuransi Anda sebelum masuk ke ruang pemeriksaan. &nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;
                Hormati sesama pasien dan petugas kesehatan. &nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;
                Untuk keperluan darurat, segera hubungi petugas di meja resepsionis. &nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;
                Halaman ini diperbarui otomatis setiap 5 detik.
            </div>
        </div>
    </div>
</body>
</html>
