import json
from jinja2 import Environment, FileSystemLoader

def generate(filename, jsonFile):
    # 1. Load the data directly from your JSON file
    with open(jsonFile, 'r') as f:
        json_data = json.load(f)

    # 2. Setup the template environment loader
    env = Environment(loader=FileSystemLoader('.'))
    template = env.get_template('Dockerfile.in')

    # 3. Pass the json data dictionary into the render process
    output_content = template.render(json_data)

    # 4. Save the generated text output
    with open(filename, 'w') as f:
        f.write(output_content)
        
    print("Generated: " + filename)

# AIO
generate('Dockerfile.dev', 'templates/dev.json')