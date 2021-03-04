from markdown.extensions import Extension
from markdown.preprocessors import Preprocessor
from markdown.blockprocessors import BlockProcessor
from markdown.inlinepatterns import SimpleTagPattern
from markdown.inlinepatterns import InlineProcessor
import xml.etree.ElementTree as etree
import re


DEL_RE = r'(\/\/)(.*?)$'

class BoxBlockProcessor(BlockProcessor):
        RE_FENCE_START = r"`{3,}" # start line, e.g., `   !!!! `
        RE_FENCE_END = r"`{3,}"  # last non-blank line, e.g, '!!!\n  \n\n'

        def test(self, parent, block):
            return re.search(self.RE_FENCE_START, block)

        def run(self, parent, blocks):
            # original_block = blocks[0]
            # blocks[0] = re.sub(self.RE_FENCE_START, '', blocks[0])
            # # Find block with ending fence
            # for block_num, block in enumerate(blocks):
            #     if re.search(self.RE_FENCE_END, block):
            #         # remove fence
            #         blocks[block_num] = re.sub(self.RE_FENCE_END, '', block)
            #         # render fenced area inside a new div
            #         e = etree.SubElement(parent, 'div')
            #         e.set('style', 'display: inline-block; border: 1px solid red;')
            #         self.parser.parseBlocks(e, blocks[0:block_num + 1])
            #         # remove used blocks
            #         for i in range(0, block_num + 1):
            #             blocks.pop(0)
            #         return True
            # blocks[0] = original_block
            return False

            
            
           
            #         # render fenced area inside a new div
            #         e = etree.SubElement(parent, 'div')
            #         e.set('style', 'display: inline-block; border: 1px solid red;')
            #         self.parser.parseBlocks(e, blocks[0:block_num + 1])
            
            #         return True  # or could have had no return statement
            # # No closing marker!  Restore and do nothing
            # blocks[0] = original_block
            # return False  # equivalent to our test() routine returning False

class NoRender(Preprocessor):
    """ Skip any line with words 'NO RENDER' in it. """
    def run(self, lines):
        new_lines = []
        for line in lines:
            print(line)
            m = re.search("//", line)
            if m:    
                # any line without NO RENDER is passed through
                new_lines.append(line)  
        return new_lines

class FenceLinkExtension(Extension):
    def extendMarkdown(self, md):
        # Create the del pattern
        # del_tag = SimpleTagPattern(DEL_RE, 'del')
        # md.inlinePatterns.add('del', del_tag, '>not_strong')
        # md.parser.blockprocessors.register(BoxBlockProcessor(md.parser), 'html_box', 20)
        pass
