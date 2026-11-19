CREATE TABLE uczniowie (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    imie TEXT NOT NULL,
    nazwisko TEXT NOT NULL,
    klasa TEXT NOT NULL
);

INSERT INTO uczniowie (imie, nazwisko, klasa) VALUES
('Jan', 'Kowalski', '4TI'),
('Anna', 'Nowak', '4TI'),
('Piotr', 'Zielinski', '4TI');