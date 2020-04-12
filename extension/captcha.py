#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3

# Python 3.7.4

# Required for CAPTCHA processing
from urllib.request import urlopen
from PIL import Image
import numpy
import cv2
import pytesseract
# Point to tesseract executable
pytesseract.pytesseract.tesseract_cmd = r'/usr/local/bin/tesseract'

# Required for native messaging
import sys
import json
import struct

# Function that solves a CAPTCHA given an image url 
# Returns the solution as a string
def solveCAPTCHA(url):
    # Open image from url in greyscale
    req = urlopen(url)
    image = numpy.asarray(bytearray(req.read()), dtype=numpy.uint8)
    image = cv2.imdecode(image, 0) 

    # Pre-process the image using threshold and erosion
    image = cv2.threshold(image, 0, 255, cv2.THRESH_BINARY | cv2.THRESH_OTSU)[1]
    kernel = numpy.ones((1,1), numpy.uint8)
    image = cv2.erode(image, kernel, iterations = 1)

    # Process the image through Tesseract
    string = pytesseract.image_to_string(image)
    text = string.replace(" ", "")

    return text

# Read a message from stdin and decode it.
def getMessage():
    rawLength = sys.stdin.buffer.read(4)
    if len(rawLength) == 0:
        sys.exit(0)
    messageLength = struct.unpack('@I', rawLength)[0]
    message = sys.stdin.buffer.read(messageLength).decode('utf-8')
    return json.loads(message)

# Encode a message for transmission, given its content.
def encodeMessage(messageContent):
    encodedContent = json.dumps(messageContent).encode('utf-8')
    encodedLength = struct.pack('@I', len(encodedContent))
    return {'length': encodedLength, 'content': encodedContent}

# Send an encoded message to stdout
def sendMessage(encodedMessage):
    sys.stdout.buffer.write(encodedMessage['length'])
    sys.stdout.buffer.write(encodedMessage['content'])
    sys.stdout.buffer.flush()

while True:
    receivedMessage = getMessage()
    captcha = solveCAPTCHA(receivedMessage["url"])
    sendMessage(encodeMessage(captcha))
    