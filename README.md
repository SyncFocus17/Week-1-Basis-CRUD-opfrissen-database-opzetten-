# Todo App Mini - Laravel CRUD Application

Een eenvoudige Todo applicatie gebouwd voor Week 1 van de cursus - Basis CRUD opfrissen & database opzetten.

## 🎯 Wat heb ik gebouwd?

Dit is een volledig functionele Todo applicatie met alle vereiste functionaliteiten:

### ✅ Vereisten Behaald
- **Model**: Task met title, description, is_done velden
- **CRUD Operations**: Create, Read, Update, Delete taken
- **Validatie**: Title verplicht, description optioneel
- **Toggle functionaliteit**: "Mark as done" button (bonus feature)
- **Database**: SQLite met migraties
- **Modern UI**: Bootstrap 5 responsive design

### 🚀 Live Demo
**Server draait op**: http://localhost:8000

### 📁 Project Structuur
```
todoapp-mini/
├── index.php                    # Main application file
├── views/                       # View templates
│   ├── index.php               # Tasks overview
│   ├── create.php              # Create new task
│   ├── edit.php                # Edit existing task
│   └── show.php                # Task details
├── database/
│   └── database.sqlite         # SQLite database
├── app/                        # Laravel-style structure
│   ├── Models/Task.php         # Task model
│   └── Http/Controllers/TaskController.php
├── resources/views/            # Blade templates (Laravel structure)
└── README.md                   # This file
```

### 🎯 Leerdoelen Behaald
- ✅ Nieuw project opgezet met routes en views
- ✅ Model en database structuur gemaakt
- ✅ Taken kunnen opslaan, aanpassen en verwijderen
- ✅ Validatie in de applicatie
- ✅ Extra: "Mark as done" toggle functionaliteit

### 🚀 Installatie & Gebruik

**Vereisten:**
- PHP 8.3+ (geïnstalleerd in project)
- SQLite ondersteuning

**Starten:**
1. **Clone repository**:
   ```bash
   git clone https://github.com/SyncFocus17/Week-1-Basis-CRUD-opfrissen-database-opzetten-.git
   cd Week-1-Basis-CRUD-opfrissen-database-opzetten-
   ```

2. **Start PHP server**:
   ```bash
   php -S localhost:8000
   ```

3. **Bezoek applicatie**:
   Open browser: http://localhost:8000

### 📸 Functionaliteiten

**Hoofdpagina (Tasks Overview)**:
- Grid layout met alle taken
- Status badges (Done/Pending)
- Quick action buttons (View, Edit, Toggle, Delete)
- Statistieken (totaal en voltooide taken)

**Nieuwe Taak Maken**:
- Formulier met validatie
- Title verplicht, description optioneel
- Directe feedback bij fouten

**Taak Bewerken**:
- Vooraf ingevulde velden
- Status indicator
- Update functionaliteit

**Taak Details**:
- Volledige taak informatie
- Timestamps (created/updated)
- Alle acties beschikbaar

**Toggle Functionaliteit (Bonus)**:
- Een-klik status wijziging
- Visuele feedback (doorgestreepte tekst)
- Kleurgecodeerde buttons

### 🛠️ Technische Implementatie

**Database (SQLite)**:
```sql
CREATE TABLE tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    is_done BOOLEAN DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

**CRUD Operations**:
- **Create**: POST met validatie
- **Read**: GET met overzicht en details
- **Update**: POST met bestaande data
- **Delete**: POST met confirmatie
- **Toggle**: POST voor status wijziging

**Validatie**:
- Server-side validatie
- Title verplicht (niet leeg)
- Description optioneel
- Error handling en feedback

**UI/UX**:
- Bootstrap 5 responsive design
- Font Awesome iconen
- Kleurgecodeerde status indicators
- Gebruiksvriendelijke navigatie

### 🎓 Cursus Vereisten Check

| Vereiste | Status | Implementatie |
|----------|--------|---------------|
| Model: Task (title, description, is_done) | ✅ | SQLite tabel + PHP class |
| CRUD (aanmaken, overzicht, bewerken, verwijderen) | ✅ | Volledige implementatie |
| Validatie in controller | ✅ | Server-side validatie |
| "Mark as done" button (bonus) | ✅ | Toggle functionaliteit |

### 📊 Project Statistieken
- **Bestanden**: 33 files
- **Code regels**: 8000+ insertions
- **Functionaliteiten**: Alle vereisten + bonus
- **Database**: SQLite met automatische setup
- **UI**: Modern, responsive design

### 🔗 Repository
**GitHub**: https://github.com/SyncFocus17/Week-1-Basis-CRUD-opfrissen-database-opzetten-.git

Dit project demonstreert een complete CRUD applicatie met moderne best practices, gebruiksvriendelijke interface en alle vereiste functionaliteiten voor Week 1 van de cursus.