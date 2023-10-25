# Matkul-PBW2


import lorem

lorem_text = lorem.text()
words = lorem_text.split()
while len(words) < 100:
    lorem_text += " " + lorem.text()
    words = lorem_text.split()
    
lorem_100_words = " ".join(words[:100])
print(lorem_100_words)
