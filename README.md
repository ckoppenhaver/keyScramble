keyScramble
===========

Key scrambling object for MySQL AES Encryption. The scrambling method acts as if shuffling a deck of cards. The way it decides which "card" goes in which half of the deck is based off of the "server key". If the keys index is Even then it goes into DeckA if it is odd the card is placed into DeckB.
